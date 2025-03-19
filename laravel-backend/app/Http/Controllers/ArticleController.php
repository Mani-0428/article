<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::with('comments')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);

        return response()->json($article);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->only('title', 'content'));
        return response()->json($article);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(['message' => 'Article deleted']);
    }
}
