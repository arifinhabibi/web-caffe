<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // login
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'message' => 'invalid field',
                'errors' => $validator->errors()
            ], 401);
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];
        
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'username or password inccorect'
            ], 401);
        } 

        Auth::user()->update([
            'token' => bcrypt($request->username)
        ]);

        return response()->json([
            'message' => 'success login',
            'id' => Auth::user()->id,
            'username' => Auth::user()->username,
            'token' => Auth::user()->token
        ], 200);

    }

    // logout
    public function logout(Request $request){
        $user = User::where('token', $request->token)->first();

        if (!$user) {
            # code...
            return response()->json([
                'message' => 'Invalid token'
            ],401);
        }

        $user->update([
            'token' => null
        ]);

        return response()->json([
            'message' => 'logout success'
        ]);
    }
}
