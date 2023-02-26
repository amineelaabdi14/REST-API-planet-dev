<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::with('user')->get();
        if ($comments) 
        {
            return response()->json([
                'message' => 'All Comments Retrieved Successfully',
                'data' => $comments
            ], 200);
        } else {
            return response()->json([
                'message'=>'No Comments Found'
            ], 400);
        }
    }

    public function show(Comment $comment)
    {
        $comment->find($comment->id);
        if (!$comment)
        {
            return response()->json(['message' => 'Comment not found'], 400);
        }
        return response()->json([
            'message' => 'Comment Retrieved Successfully',
            'data' => $comment
        ], 200);
    }

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
        $user = Auth::user();
        $article = Article::find($article_id);
        if(!$user->can('delete every comment') && $user->id != $article->user_id)
        {
            return $this->apiResponse(null, 'you dont have permission to edit this article', 400);
        }
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
        $user = Auth::user();
        $article = Article::find($article_id);
        if(!$user->can('edit every comment') && $user->id != $article->user_id)
        {
            return $this->apiResponse(null, 'you dont have permission to edit this article', 400);
        }
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