<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginControler extends Controller
{
    public function __invoke(Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid Username and Password Combination!'
            ], 401);
        }
        else { 
            $user = Auth::user();
            $accesstoken = $user->createToken('twitter token')->accessToken;
            return response()->json([
                'success' => true,
                 'data' => ['user' => $user, 'accessToken' => $accesstoken]
            ]);
        }   
       
    }
}
