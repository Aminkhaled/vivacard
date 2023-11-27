<?php

namespace Modules\Main\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Main\Http\Requests\ArticleCategoryRequest;

use Modules\Main\Models\ArticleCategory;
use Modules\Main\Models\ArticleCategoryTranslation;


class ArticlesCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'articles_category_translations.articles_categories_name' => [request('name'), 'like'],
            'articles_categories.articles_categories_status' => [request('status'), '=']

        ];
        request()->flash();

        $query = ArticleCategory::join('articles_category_translations', 'articles_categories.articles_categories_id', 'articles_category_translations.articles_categories_id')
        ->where('articles_categories.articles_categories_status', '!=', '2')
        ->groupBy('articles_categories.articles_categories_id')
        ->sorted();


        $searchQuery = $this->searchIndex($query, $searchArray);

        $articles_categories = $searchQuery->paginate(env('PerPage'));

        return view('main::admin.articles_categories.index', compact('articles_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('main::admin.articles_categories.create');

    }

     /**


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\ArticleCategoryReques  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCategoryRequest $request)
    {
        $category = ArticleCategory::create($request->all());
        return redirect()->route('admin.articles_categories.index')->with('status', __('main::lang.createdDone'));
    }



    /**
     * Display the specified resource.
     *
     * @param  \Modules\Main\Models\ArticleCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =ArticleCategory::findOrFail($id) ;
        // return $category ;
        request()->flash();
        return view('main::admin.articles_categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Main\Models\ArticleCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category =ArticleCategory::findOrFail($id) ;
        request()->flash();
        // return $category;
        return view('main::admin.articles_categories.edit', compact('category'));
    }



        /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\ArticleCategoryReques  $request
     * @param  \Modules\Main\Models\ArticleCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleCategoryRequest $request,  $id)
    {
        // Update ArticleCategory
        $category =  ArticleCategory::findOrFail($id) ;
        $category->update($request->all());

        return redirect()->route('admin.articles_categories.index')->with('status', __('main::lang.updatedDone'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Main\Models\ArticleCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $category =  ArticleCategory::findOrFail($id) ;
        $category->delete();

        return back()->with('status', __('main::lang.deletedDone'));
    }

    public function changeStatus($id, $status)
    {
        $category = ArticleCategory::find($id);
        if($category){
            $category->articles_categories_status = $status ;
            $category->save();
        }
        return response(['msg' =>  __('main::lang.updatedDone')], 200);
    }

}
