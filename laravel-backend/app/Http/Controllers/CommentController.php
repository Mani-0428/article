<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'comment' => 'required|string',
        ]);

        $comment = Comment::create([
            'article_id' => $request->article_id,
            'user_id' => $request->user()->id,
            'comment' => $request->comment,
        ]);

        return response()->json($comment);
    }
}
