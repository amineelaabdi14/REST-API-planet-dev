<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id')->get();

        return response()->json([
            'status' => 'success',
            'articles' => $articles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        $article = Article::create($request->all());
        return response()->json([
            'status' => true,
            'message' => "Article Created successfully!",
            'article' => $article
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request  $req)
    {
        $article=Article::Find($req->id);
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }
        return response()->json($article, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $article=Article::Find($request->id);

        if(!$user->can('edit every article') && $user->id != $article->user_id)
        {
            return $this->apiResponse(null, 'you dont have permission to edit this article', 400);
        }

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }
        $article->title=$request->title;
        $article->content=$request->content;
        $article->author=$request->author;
        $article->tags=$request->tags;
        $article->category_id=$request->category_id;
        $article->save();

        return response()->json([
            'status' => true,
            'message' => "Article Updated successfully!",
            'article' => $article
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $user = Auth::user();
        if(!$user->can('delete every article') && $user->id != $article->user_id)
        {
            return $this->apiResponse(null, 'you dont have permission to edit this article', 400);
        }
        
        $article->delete();

        if (!$article) {
            return response()->json([
                'message' => 'Article not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Article deleted successfully'
        ], 200);
    }
}