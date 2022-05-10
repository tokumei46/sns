<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatsController;


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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [PostsController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//認証付きルーティング user
Route::middleware(['auth'])->group(function () {
    Route::prefix('users/{id}')->group(function () {
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow');
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings');
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');
        Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');
        Route::get('profile', [UsersController::class, 'showPro'])->name('profile');
    });
    Route::resource('users', UsersController::class)->only(['index','show']);
    Route::resource('chat', ChatsController::class);


    Route::put('profile', [UsersController::class, 'profileUpdate'])->name('profile_edit');
    Route::put('password_change', [UsersController::class, 'passwordUpdate'])->name('password_edit');

    Route::prefix('posts/{post}')->group(function () {
        Route::post('favorite', [FavoritesController::class, 'store'])->name('post.favorite');
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('post.unfavorite');
        Route::resource('replies', RepliesController::class);
        Route::get('replies', [RepliesController::class, 'reps'])->name('get.reps');
        
    });

    Route::resource('posts', PostsController::class);
});


