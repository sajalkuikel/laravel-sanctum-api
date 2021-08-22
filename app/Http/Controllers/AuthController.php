<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register ( Request $request ){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $request['password'] = bcrypt($request['password']);

        $user = User::create($request->all());

        $token = $user->createToken('token')->plainTextToken;

        return ['message' => 'Registered!' ,  'token' => $token ];
     }
}
