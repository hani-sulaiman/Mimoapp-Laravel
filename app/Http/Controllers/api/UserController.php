<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            
            $user = Auth::user();
            $token = $user->createToken('Mimo app')->plainTextToken;

            return response()->json([
                'message' => 'Logged in successfully',
                'user' => $user,
                'token' => $token,
            ],200);
        }

        return response()->json(['message' => 'The provided credentials do not match our records.'], 401);
    
    }
    public function signup(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
    
        $token = $user->createToken('Mimo app')->plainTextToken;
    
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
            'token' => $token,
        ]);
    }
}
