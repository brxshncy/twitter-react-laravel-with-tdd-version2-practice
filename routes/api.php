<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginControler;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\WhoToFolowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:api']], function (){

    Route::get('users/notfollow', WhoToFolowController::class)->name('who.to.follow.users');
    Route::resource('user', UserController::class)->except(['store']);
    Route::resource('tweet', TweetsController::class);
    Route::resource('follow', UserFollowController::class);
    Route::resource('comment', CommentController::class);
    
});


Route::post('register', [UserController::class, 'store'])->name('register');
Route::post('logn', LoginControler::class)->name('login');
