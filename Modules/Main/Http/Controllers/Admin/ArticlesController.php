<?php

namespace Modules\Main\Http\Controllers\Admin;
use Modules\General\Models\StorageHandle;

use App\Http\Controllers\Controller;
use Modules\Main\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Modules\Main\Models\Article;
use Modules\Main\Models\ArticleCategory;
use Modules\General\Models\Language;
use Illuminate\Support\Facades\Validator;
class ArticlesController extends Controller
{
    use StorageHandle;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'article_translations.articles_title' => [request('title'), 'like'],
            'articles.articles_date' => [request('date'), '='],
            'articles.articles_status' => [request('status'), '='],
            'articles.articles_featured' => [request('articles_featured'), '='],

        ];
        request()->flash();

        $query = Article::join('article_translations', 'articles.articles_id', 'article_translations.articles_id')
        ->where('articles.articles_status', '!=', '2')
        ->groupBy('articles.articles_id')
        ->sorted() ;

        $searchQuery = $this->searchIndex($query, $searchArray);
        $count_articles = $searchQuery->get()->count('articles.articles_id');
        $articles = $searchQuery->paginate(env('PerPage'));

        return view('main::admin.articles.index', compact('articles','count_articles'));
    }



    /**
     * Show the form for creating a article resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ArticleCategory::all() ;
        //  return $categories ;
        return view('main::admin.articles.create',compact('categories'));
    }




    /**
     * Store a articlely created resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\ArticleReques  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        if($request->articles_images && $request->articles_image ){
            $result = $this->checkArticleImages($request->articles_image, $request->articles_images);
            if(!$result){
                return redirect()->back()->with('status_danger', __('main::lang.allImagesMustBeSameName'));
            }
        }
        // dd($request->all());
        $article = Article::create($request->all());
        if($article){
            $languages =  Language::active()->get();
            foreach ($languages as $language) {
                $name = $request->get($language->locale);
                $article->translateOrNew($language->locale)->articles_slug = make_slug($name['articles_title']);
                $article->save();
            }
            if($request->articles_images){
                $this->storeArticleImages($article->articles_id, $request->articles_images);
            }
         }

        return redirect()->route('admin.articles.index')->with('status', __('main::lang.createdDone'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\ArticleReques  $request
     * @return \Illuminate\Http\Response
     */
    public function storeArticleImages($articleID, $images)
    {

        foreach ($images as $image) {
            $current_name = $this->currentName($image);

            if($current_name){
                $this->originalImage($image, $current_name,'articles');
                $this->mediumImage($image, $current_name,null,400,'articles');
                $this->thumbImage($image, $current_name,100,null,'articles');
            }
        }
        return true;
    }

    public function checkArticleImages($image_name, $images){
        $articlesDestination = env('pathimages','public/uploads').'/articles';
        $file = $articlesDestination . '/original/' . $image_name;
        $info = pathinfo($file);
        $file_name =  $info['filename'];
        foreach($images as $image){
            $img_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) ;
            if($img_name != $file_name){
                return false ;
            }
        }
        return true ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Main\Models\Article  $Article
     * @return \Illuminate\Http\Response
     */
    public function show( $article)
    {
        $article = Article::findOrFail($article) ;
        request()->flash();
        return view('main::admin.articles.show', compact('article'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Main\Models\Article  $Article
     * @return \Illuminate\Http\Response
     */
    public function edit( $article)
    {
        $article = Article::findOrFail($article) ;
        $categories = ArticleCategory::sorted()->get() ;
        request()->flash();

        return view('main::admin.articles.edit', compact('article','categories'));
    }



        /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\ArticleReques  $request
     * @param  \Modules\Main\Models\Article  $Article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $article)
    {
        if($request->articles_images && $request->articles_image ){
            $result = $this->checkArticleImages($request->articles_image, $request->articles_images);
            if(!$result){
                return redirect()->back()->with('status_danger', __('main::lang.allImagesMustBeSameName'));
            }
        }

        // Update Article
        $articles = Article::findOrFail($article) ;
        $articles->update($request->all());
        if($articles){
            $languages =  Language::active()->get();
            foreach ($languages as $language) {
                $name = $request->get($language->locale);
                $articles->translateOrNew($language->locale)->articles_slug = make_slug($name['articles_title']);
                $articles->save();
            }

            if($request->articles_images){
                $this->storeArticleImages($articles->articles_id, $request->articles_images);
            }
         }

        return redirect()->route('admin.articles.index')->with('status', __('main::lang.updatedDone'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Main\Models\Article  $Article
     * @return \Illuminate\Http\Response
     */
    public function destroy( $article)
    {
        $article = Article::findOrFail($article) ;
        // return $article->articles_image ;
        $this->deleteFiles($article->articles_image) ;
        $article->delete();

        return back()->with('status', __('main::lang.deletedDone'));
    }

    public function changeStatus($id, $status)
    {
        $article = Article::find($id);
        if($article){
            if(request()->field && request()->field == 'articles_featured'){
                $article->articles_featured = $status ;
            }else{
                $article->articles_status = $status ;
            }
            $article->save();
        }
        return response(['msg' =>  __('main::lang.updatedDone')], 200);
    }


}
