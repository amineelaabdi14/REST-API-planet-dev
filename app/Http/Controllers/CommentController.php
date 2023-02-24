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

    public function delete($article_id, $comment_id, Request $request)
    {
        $article = Article::find($article_id);
        if ($article) {
            $comment = Comment::find($comment_id);
        if ($comment) {
            if ($comment->user_id == $request->user()->id) {
                $comment->delete();
                return response()->json([
                    'message' => 'Comment Successfully Deleted',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'You do not have permission to delete this comment',
                ], 403);
            }
        } else {
            return response()->json([
                'message' => 'Comment not found',
            ], 404);
        }
        } else {
            return response()->json([
            'message' => 'No Article Found',
            ], 400);
        }
    }

    public function update($article_id, $comment_id, Request $request)
    {
        $article = Article::find($article_id);
        if ($article) {
            $comment = Comment::find($comment_id);
        if ($comment) {
            if ($comment->user_id == $request->user()->id) {
                $comment->update([
                    'body' => $request->input('body')
                ]);
                return response()->json([
                    'message' => 'Comment Successfully Updated',
                    'comment' => $comment
                ], 200);
            } else {
                return response()->json([
                    'message' => 'You do not have permission to update this comment',
                ], 403);
            }
            } else {
                return response()->json([
                'message' => 'Comment not found',
                ], 404);
            }
        } else {
            return response()->json([
            'message' => 'No Article Found',
            ], 400);
        }
    }

}
