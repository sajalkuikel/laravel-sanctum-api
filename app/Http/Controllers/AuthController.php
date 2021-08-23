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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        // Hashing the entered password with default hash
        $request['password'] = bcrypt($request['password']);

        $user = User::create($request->all());

        $token = $user->createToken('token')->plainTextToken;

        return ['message' => 'Registered!' ,  'token' => $token ];
    }


    public function logout(){

        //destroy all the tokens associated with the user.
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out!'
        ];
    }


    public function login ( Request $request ){

//        validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //email check
        $user  = User::where('email' , $request->email)->first();

        //email and password check
        if( !$user ||  !Hash::check($request->password , $user->password) ){
            return [
                "message" => 'Invalid credentials!'
            ];
        }

        // Generate the token if the credentials are correct
        $token = $user->createToken('token')->plainTextToken;


        //Return a success message
        return ['message' => 'Logged in !' ,  'token' => $token ];
    }

}
