<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     $articles = Article::orderBy('id')->get();

    //     return response()->json([
    //         'status' => 'success',
    //         'articles' => $articles
    //     ]);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(StoreArticleRequest $request)
    // {
    //     $article = Article::create($request->all());

    //     return response()->json([
    //         'status' => true,
    //         'message' => "Article Created successfully!",
    //         'article' => $article
    //     ], 201);
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Article  $article
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Article $article)
    // {
    //     $article->find($article->id);
    //     if (!$article) {
    //         return response()->json(['message' => 'Article not found'], 404);
    //     }
    //     return response()->json($article, 200);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Article  $article
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(StoreArticleRequest $request, Article $article)
    // {
    //     $article->update($request->all());

    //     if (!$article) {
    //         return response()->json(['message' => 'Article not found'], 404);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => "Article Updated successfully!",
    //         'article' => $article
    //     ], 200);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Article  $article
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Article $article)
    // {
    //     $article->delete();

    //     if (!$article) {
    //         return response()->json([
    //             'message' => 'Article not found'
    //         ], 404);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Article deleted successfully'
    //     ], 200);
    // }
}