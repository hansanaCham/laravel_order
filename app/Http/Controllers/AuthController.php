<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Responce;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
         $fields =  $request->validate([
            'name' => 'required|string',
            'email' =>'required|unique:users,email',
            'password' => 'required|string',
         ]);
         $user = User::create([
            'name'=> $fields['name'],
            'email'=>$fields['email'],
            'password' => bcrypt($fields['password'])
         ]);
         $token = $user->createToken('myapp_token')->plainTextToken;
         $responce = [
            'user' => $user,
            'token' => $token
         ];

         return response($responce,201);
    }

    public function signIn(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
    
      
        $user = User::where('email', $fields['email'])->first();
    
       
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }
    
        $token = $user->createToken('myapp_token')->plainTextToken;
    
        $response = [
            'user' => $user,
            'token' => $token
        ];
    
        return response($response, 200);
    }

    public function signOut(Request $request) {
       
        $user = auth()->user();
    
        
        $user->tokens()->delete();
    
        return response([
            'message' => 'Logged out successfully'
        ], 200);
    }
}
