<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

// Public Routes (Accessible without authentication)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Requires authentication via Sanctum)
Route::middleware('auth:sanctum')->group(function () {

    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout']);

    // Articles Routes
    Route::get('/articles', [ArticleController::class, 'index']);  // Get all articles
    Route::post('/articles', [ArticleController::class, 'store']); // Create a new article
    Route::get('/articles/{article}', [ArticleController::class, 'show']); // Get a single article
    Route::put('/articles/{article}', [ArticleController::class, 'update']); // Update an article
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy']); // Delete an article

    // Comments Routes
    Route::post('/articles/{article}/comments', [CommentController::class, 'store']); // Add a comment to an article
    Route::get('/articles/{article}/comments', [CommentController::class, 'index']); // Get all comments for an article
});
