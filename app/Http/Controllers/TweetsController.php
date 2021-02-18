<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $data = [];

        $followedUserId = Auth::user()->followings()->pluck('users.id')->toArray();


        $data['tweet'] = Tweet::with('user')
                                ->withCount('comments')
                                ->whereIn('user_id', $followedUserId)
                                ->orWhere('user_id', $user->id)
                                ->latest()->get();

        $data['comments_count'] = $data['tweet']->map(function ($q) {
                return collect($q)->only(['comments_count']);
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        $data = [];

        $request->merge([
            'user_id' => Auth::user()->id
        ]);

        $data['tweet'] = Tweet::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

   
    public function show(Tweet $tweet)
    {
        $data = [];

        $data['tweet'] = $tweet->with('user')
                                ->withCount('comments')
                                ->latest()->get();

        $data['comments_count'] = $tweet->latest()->get()->map(function ($q) {

                     return collect($q)->only(['comments_count']);

        });

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy(Tweet $tweet, User $user)
    {
        $tweet->where('user_id', Auth::user()->id);
        
    }
}
