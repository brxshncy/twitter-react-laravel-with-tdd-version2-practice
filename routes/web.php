<?php

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

$tweets = Tweet::inRandomOrder()->first();



Route::get('test', function (){

    $data = [];


    $user = Auth::loginUsingId(91);

    $followedUserId = Auth::user()->followings()->pluck('users.id')->toArray();


        $data['tweet'] = Tweet::with('user')
                        ->withCount('comments')
                        ->whereIn('user_id', $followedUserId)
                        ->orWhere('user_id', $user->id)
                        ->latest()->get();

     $data['comments_count'] = $data['tweet']->map(function ($q) {
          return collect($q)->only(['comments_count']);
     });

     return $data;
 
});

Route::get('/', function () {
    return 'test';
});
