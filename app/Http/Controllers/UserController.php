<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }
    public function store(UserRequest $request)
    {
            
            $data = [];
            $request->merge(['password' => bcrypt($request->password)]);

            $data['user'] = User::create($request->all());
            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
    }   


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

 
    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id)
    {
        
    }
}
