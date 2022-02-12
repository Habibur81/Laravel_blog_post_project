<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Comment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HomeController Route
Route::get('/', [HomeController::class, 'index'])
    ->name('home');
    //middleware('auth)

Route::get('/contact', [HomeController::class, 'contact'])
    ->name('contact');

Route::get('/secret', [HomeController::class, 'secret'])
    ->name('secret')
    ->middleware('can:home.secret');

// PostController Route

Route::resource('posts', PostController::class);
    // ->only('index', 'show', 'create', 'store', 'edit', 'update', 'destroy');

Route::get('/posts/tag/{tag}', [PostTagController::class, 'index'])->name('posts.tags.index');

Route::resource('posts.comments', PostCommentController::class)->only(['index','store']);

Route::resource('users.comments', UserCommentController::class)->only(['store']);

Route::resource('/users', UserController::class)->only(['show', 'edit', 'update']);

Route::get('mailable', function(){

        $comment = Comment::find(1);

        return new App\Mail\CommentPostedMarkdown($comment);

});

Auth::routes();
