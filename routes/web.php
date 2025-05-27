<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LikeDislikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'posts'])->name('posts');
Route::get('/p/{id}', [GuestController::class, 'post'])->name('post');
Route::get('/u/{username}', [GuestController::class, 'user'])->name('user');

Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/signup', function () { return view('signup'); })->name('signup');
Route::post('/login', [GuestController::class, 'login'])->name('login');
Route::post('/signup', [GuestController::class, 'signup'])->name('signup');

Route::middleware(['auth'])->group(function () {
    Route::get('/buat_postingan', function () { return view('post.make'); })
        ->name('post.make');
    Route::get('/p/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::get('/p/{id}/hapus', [PostController::class, 'delete'])
        ->name('post.delete');
    Route::get('/p/{id}/remove_image', [PostController::class, 'remove_image'])
        ->name('post.remove_image');
    Route::post('/buat_postingan', [PostController::class, 'create']);
    Route::post('/p/{id}/edit', [PostController::class, 'update'])
        ->name('post.update');

    Route::post('/p/{post_id}/komentar', [CommentController::class, 'add'])
        ->name('comment.add');
    Route::get('/p/{}/hapus_komentar/{id}', [CommentController::class, 'remove'])
        ->name('comment.remove');

    Route::get('/p/{post_id}/like', [LikeDislikeController::class, 'like'])
        ->name('post.like');
    Route::get('/p/{post_id}/dislike', [LikeDislikeController::class, 'dislike'])
        ->name('post.dislike');

    Route::get('/account', [UserController::class, 'account'])->name('user.account');
    Route::get('/account/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/account/confirm_delete', function () {return view('user.confirm_delete'); })
        ->name('user.confirm_delete');
    Route::get('/account/logout', [UserController::class, 'logout'])
        ->name('user.logout');
    Route::post('/account/edit', [UserController::class, 'update'])
        ->name('user.update');
    Route::post('/account/confirm_delete', [UserController::class, 'delete'])
        ->name('user.delete');
});