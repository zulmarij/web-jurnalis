<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['web'])
    ->prefix('articles')
    ->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('/all', [PostController::class, 'allPosts'])->name('post.all');
        Route::get('/search', [PostController::class, 'search'])->name('post.search');
        Route::get('/{post:slug}', [PostController::class, 'show'])->name('post.show');
        Route::post('/subscribe', [PostController::class, 'subscribe'])
            ->middleware('throttle:5,1')
            ->name('post.subscribe');

        Route::get('/categories/{category:slug}', [CategoryController::class, 'posts'])->name('category.post');
        Route::get('/tags/{tag:slug}', [TagController::class, 'posts'])->name('tag.post');

        Route::post('/posts/{post:slug}/comment', [CommentController::class, 'store'])->middleware('auth')->name('comment.store');

        // Route::get('/login', function () {
        //     redirect(\route('post.login'));
        // })->name('post.login');
    });
