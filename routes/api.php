<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WritterController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikePostController;
use App\Http\Controllers\LikeCommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FeaturedController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Protected Routes
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::resource('writter', WritterController::class);
    Route::resource('reader', ReaderController::class);
    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('comment', CommentController::class);

    Route::controller(LikePostController::class)->group(function () {
        Route::get('/like/post/{slug}', 'show');
        Route::post('/like/post/{slug}', 'store');
        Route::post('/dislike/post/{slug}', 'destroy');
    });

    Route::controller(LikeCommentController::class)->group(function () {
        Route::get('/like/comment/{id}', 'show');
        Route::post('/like/comment/{id}', 'store');
        Route::post('/dislike/comment/{id}', 'destroy');
    });

    Route::controller(FollowController::class)->group(function () {
        Route::get('/follower/{id}', 'showFollower');
        Route::get('/following/{id}', 'showFollowing');
        Route::post('/follow/{id}', 'store');
        Route::post('/unfollow/{id}', 'destroy');
    });

    Route::controller(FeaturedController::class)->group(function () {
        Route::get('/featured/post', 'showFeaturedPost');
        Route::post('/featured/post/{slug}', 'storeFeaturedPost');
        Route::get('/featured/writter', 'showFeaturedWritter');
        Route::post('/featured/writter/{id}', 'storeFeaturedWritter');
    });
});
