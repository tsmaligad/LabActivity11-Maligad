<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthorController;

Route::redirect('/', '/posts');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index');

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])
        ->name('posts.create');

    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store');
});

Route::get('/posts/{id}', [PostController::class, 'show'])
    ->name('posts.show');

Route::get('/authors/{author}', [AuthorController::class, 'show'])
    ->name('authors.show');
