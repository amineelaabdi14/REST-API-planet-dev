<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create($article_id, Request $request)
    {
        $article = Article::find($article_id);
        if ($article)
        {
            $request->validate([
                'body' => 'required'
            ]);

            $comment = Comment::create([
                'body'=>$request->body,
                'article_id'=>$article->id,
                'user_id'=>$request->user()->id
            ]);
            $comment->load('user');
            return response()->json([
                'message'=>'Comment Successfully Created',
                'data'=>$comment
            ], 200);

        } else {
            return response()->json([
                'message'=>'No Article Found'
            ], 400);
        }
    }
}
