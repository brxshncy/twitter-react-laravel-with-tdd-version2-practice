<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhoToFolowController extends Controller
{
    public function __invoke()
    {
        $data = [];
        
        $whoToFollowId = Auth::user()->followings()->pluck('users.id')->toArray();

        $data['users'] = User::whereNotIn('id', $whoToFollowId)->latest()->get();

      
        return response()->json([
            'data' => $data
        ], 200);

    }
}
