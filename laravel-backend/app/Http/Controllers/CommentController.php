<?php
// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store a new comment for a specific article
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = Comment::create([
            'article_id' => $article->id,
            'user_id' => auth()->user()->id, // Make sure to link the comment to the authenticated user
            'comment' => $request->comment,
        ]);

        return response()->json($comment, 201);
    }

    // Get all comments for a specific article
    public function index(Article $article)
    {
        return response()->json($article->comments);
    }
}
