<?php

namespace Modules\Main\Http\Controllers\Admin;
use Modules\General\Models\StorageHandle;

use App\Http\Controllers\Controller;
use Modules\Main\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Modules\Main\Models\Category;
use Modules\Main\Models\CategoryTranslation;
use Modules\Main\Models\Country;
use Modules\General\Models\Language;
use Modules\Main\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Main\Exports\CategoriesEx;

class CategoriesController extends Controller
{
     use StorageHandle;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Category::rebuild();

        $searchArray = [
            'category_translations.categories_name' => [request('name'), 'like'],
            'categories.categories_status' => [request('status'), '='],
            'categories.categories_parent_id' => [request('parent'), '='],
            'categories.categories_id' => [request('categories_id'), '='],
            'categories.categories_code' => [request('categories_code'), '='],
        ];
        request()->flash();

        $query = Category::join('category_translations', 'categories.categories_id', 'category_translations.categories_id')
        ->groupBy('categories.categories_id')
        ->sorted();

        $searchQuery = $this->searchIndex($query, $searchArray);

        $categories = $searchQuery->paginate(env('PerPage'));
        $categoryForSelect =  Category::all();
        return view('main::admin.categories.index', compact('categories','categoryForSelect'));
    }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subcategories()
    {
        $searchArray = [
            'category_translations.categories_name' => [request('name'), 'like'],
            'categories.categories_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = Category::join('category_translations', 'categories.categories_id', 'category_translations.categories_id')
        ->where('categories.categories_status', '!=', '2')
        ->where('categories.categories_parent_id', '!=', null)
        ->groupBy('categories.categories_id')
        ->with('category')
        ->sorted();

        $searchQuery = $this->searchIndex($query, $searchArray);

        $subcategories = $searchQuery->paginate(env('PerPage'));

        return view('main::admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $allLeavesIds = Category::allLeaves()->get();

        return view('main::admin.categories.create', compact( 'categories','allLeavesIds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\CategoryReques  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        // insert new category
        $category = Category::create($request->all());

        // Insert Category Translation
        $this->addTranslation($category, $request);
        return redirect()->route('admin.categories.index')->with('status', __('main::lang.categoryCreated'));
    }

      /**
     * Insert into category translation model
     * @param  Category $category [description]
     * @return [type]             [description]
     */
    private function addTranslation(Category $category, Request $request)
    {
        $langs =  Language::pluck('locale')->toArray();

        foreach ($langs as $lang) {
            // dd($lang);
            $category->trans()->create([
               'locale'             => $lang,
               'categories_name'   => $request[$lang]['categories_name'],
               'categories_slug'    => make_slug($category->categories_code.' '.$request[$lang]['categories_name']),
            ]);
        }
    }

    /**
     * Handle Category Tree after Update Parent Category
     * @param  Category $category [description]
     * @return [type]             [description]
     */
    private function handleTreeWhenCreate(Category $category, Request $request)
    {
        // if no Parent, then Create this Category as Root
        if (!$request->categories_parent_id) {
            $category = Category::create($request->all());

        } else {
            $root = Category::find($request->categories_parent_id);

            $category = Category::create($request->all());
            $category->makeChildOf($root);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Main\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        request()->flash();
        return view('main::admin.categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Main\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        request()->flash();
        $categoryIds = $category->getDescendantsAndSelf()->pluck('categories_id')->toArray() ;
        $categories = Category::whereNotIn('categories_id', $categoryIds)->get();
        // $categories = Category::where('categories_id', '!=', $category->categories_id)->get();
        $allLeavesIds = Category::allLeaves()->get();

        return view('main::admin.categories.edit', compact('category','categories','allLeavesIds'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\CategoryReques  $request
     * @param  \Modules\Main\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // get old image
        $old_image = $category->categories_image;

        // Get Category before Update it
        $categoryBeforeUpdating = clone $category;

        // Update Category
        $category->update($request->all());

        // Update Descendants
        $this->updateDescendants($category);

        // Handle Category Tree when update category parent
        $this->handleTreeWhenUpdate($category, $request);

        // Edit Category Translation
        $this->editTranslation($category, $request);

        // if discount rate value has been changed, then Apply Discount Rate on all Category Products
        if ($categoryBeforeUpdating->categories_discount_rate != $request->categories_discount_rate) {

            $this->updateDiscountRate($request, $category);
        }

        // Delete old image
        $new_image = $category->categories_image;
        if ($old_image != $new_image) {
            $category->deleteFiles($old_image);
        }
        if($request->delete_image){
            $category->deleteFiles($old_image);
            $category->categories_image = null ;
            $category->save();
        }

        if($request->categories_allow_comparison == 1){
            $CategoryComparison = CategoryComparison::updateOrCreate(['categories_id' => $category->categories_id], $request->all());
        }

        $parentCategory = Category::find($request->categories_parent_id);
        if($parentCategory && $parentCategory->categories_allow_comparison == 1){
            CategoryComparison::where('categories_id',$request->categories_parent_id)->delete();
            $products_ids = Product::where('categories_id',$request->categories_parent_id)->pluck('products_id') ;
            ProductComparison::whereIn('products_id',$products_ids)->delete();
            $parentCategory->categories_allow_comparison = 0 ;
            $parentCategory->save();
        }

        return redirect()->route('admin.categories.index')->with('status', __('main::lang.categoryUpdated'));
    }


    /**
     *
     * Update the Descendants Categories.
     *
     * @return \Illuminate\Http\Response
     */
    private function updateDescendants($category)
    {
        $childs = $category->getDescendants();

        if ($childs->isNotEmpty()) {
            foreach ($childs as $child) {
                $child->categories_status = $category->categories_status;
                $child->save();
                $locales =  Language::pluck('locale')->toArray();
                foreach ($locales as $locale) {
                    $childTrans = CategoryTranslation::where('categories_id',$child->categories_id)->where('locale',$locale)->first();
                    $childTrans->save();
                }

            }
        }

        return true;

    }


    /**
     * Edit category translation model
     * @param  Category $category [description]
     * @return [type]             [description]
     */
    private function editTranslation(Category $category, Request $request)
    {
        $langs = Language::pluck('locale')->toArray();

        foreach ($langs as $lang) {
            $category->trans()->where('locale', $lang)->update([
               'categories_name'   => $request[$lang]['categories_name'],
               'categories_slug'    => make_slug($category->categories_code.' '.$request[$lang]['categories_name']),
            ]);
        }
    }

    /**
     * Handle Category Tree after Update Parent Category
     * @param  Category $category [description]
     * @return [type]             [description]
     */
    private function handleTreeWhenUpdate(Category $category, Request $request)
    {
        // if no parent_id selected, then make this category as Root if it not root
        if (!$request->categories_parent_id) {
            // if this is not root and no given parent_id, then make it as root
            if (!$category->isRoot()) {
                $category->makeRoot();
            }

        } else {
            // if parent_id given, then make this category child of given category
            $root = Category::find($request->categories_parent_id);
            $category->makeChildOf($root);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Main\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $ids = $category->getDescendantsAndSelf()->pluck('categories_id') ;
      
        $this->deleteFiles($category->categories_image) ;
        $category->delete();
        return back()->with('status', __('main::lang.categoryDeleted'));
         

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function suggestionsCategories()
    {
        $searchArray = [
            'category_translations.categories_name' => [request('name'), 'like'],
            'categories.categories_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = Category::join('category_translations', 'categories.categories_id', 'category_translations.categories_id')
        ->where('categories.categories_status', '2')
        ->groupBy('categories.categories_id')
        ->sorted();

        $searchQuery = $this->searchIndex($query, $searchArray);
        $categories = $searchQuery->paginate(env('PerPage'));

        return view('main::admin.categories.suggestions', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\CategoryReques  $request
     * @param  \Modules\Main\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function suggestionsCategoriesAccept($id)
    {
        $category = Category::findOrFail($id);
        $category->categories_status = '1';
        $category->save();

        return redirect()->route('admin.categories.suggestionsCategories')->with('status', __('main::lang.categoryAccept'));
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx,xlx',
        ]);
        Excel::import(new CategoriesImport,request()->file('file'));
  
        return back()->with('status', __('main::lang.importSuccess'));

    }

      /**
    * @return \Illuminate\Support\Collection
    */
    public function export(Request $request)
    {
        $categories = Category::all();
        return new CategoriesEx($categories);
    }

    public function changeStatus($id, $status)
    {
        $category = Category::find($id);
        if($category){
            $category->categories_status = $status ;
            $category->save();
        }
        return response(['msg' =>  __('main::lang.updatedDone')], 200);
    }
}
