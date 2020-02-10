<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;//
use App\Article;//
use App\Http\Resources\Article as ArticleResource;//

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Get articles
        $articles = Article::paginate(20);
        //Return collection of articles as a resource
        return ArticleResource::collection($articles);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $article = $request->isMethod('put') ? Article::findOrFail
        ($request->article_id) : new Article;

        $article->id = $request->input('article_id');
        $article->article_title = $request->input('article_title');
        $article->article_excerpt = $request->input('article_excerpt');
        $article->article_content = $request->input('article_content');
        $article->article_name = $request->input('article_name');
        $article->article_status = $request->input('article_status');
        $article->article_guid = $request->input('article_guid');
        
            if($article->save()){
                return [
                    'Success Message' => 'Article added'
                ];
            }else{
                return [
                    'Fail Message' => 'Article not added'
                ];
            }
    }

     /**
     * Show the form for show resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Show Single Article
        $article = Article::findOrFail($id);
        //Return Single Article
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Article
        $article = Article::findOrFail($id);

        if($article->delete()){
            return [
                'Message' => 'Article deleted successfully.'
            ];
        }else{
            return [
                'Message' => 'Article not deleted'
            ];
        }
    }
}
