<?php

use App\Livewire\Home;
use App\Livewire\Post;
use App\Livewire\PostsByCategory;
use App\Livewire\PostsByTag;
use App\Livewire\PostsByAuthor;
use Awcodes\Curator\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/category/{slug}', PostsByCategory::class)->name('posts-by-category');
Route::get('/tag/{slug}', PostsByTag::class)->name('posts-by-tag');
Route::get('/author/{username}', PostsByAuthor::class)->name('posts-by-author');
Route::get('/{slug}', Post\Show::class)->name('post.show');

Route::prefix(config('curator.glide.route_path', 'curator'))
    ->get('/{path}', [MediaController::class, 'show'])
    ->where('path', '.*');

// Route::middleware(['web'])
//     ->prefix('articles')
//     ->group(function () {
//         Route::get('/', [PostController::class, 'index'])->name('post.index');
//         Route::get('/all', [PostController::class, 'allPosts'])->name('post.all');
//         Route::get('/search', [PostController::class, 'search'])->name('post.search');
//         Route::get('/{post:slug}', [PostController::class, 'show'])->name('post.show');
//         Route::post('/subscribe', [PostController::class, 'subscribe'])
//             ->middleware('throttle:5,1')
//             ->name('post.subscribe');

//         Route::get('/categories/{category:slug}', [CategoryController::class, 'posts'])->name('category.post');
//         Route::get('/tags/{tag:slug}', [TagController::class, 'posts'])->name('tag.post');

//         Route::post('/posts/{post:slug}/comment', [CommentController::class, 'store'])->middleware('auth')->name('comment.store');

//         // Route::get('/login', function () {
//         //     redirect(\route('post.login'));
//         // })->name('post.login');
//     });
