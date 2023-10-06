<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller {
    // register a new user method
    public function register(Request $request)
{
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'type_user' => 'required|string|in:admin,user',
        'enterprise' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    // Créez l'utilisateur avec le mot de passe encrypté
    $user = User::create([
        'firstname' => $request->input('firstname'),
        'lastname' => $request->input('lastname'),
        'type_user' => $request->input('type_user'),
        'enterprise' => $request->input('enterprise'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    return response()->json(['status' => 'success', 'user' => $user]);
}


    // login a user method
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    return response()->json(['message' => 'Unauthorized'], 401);
}

    // logout a user method
      public function logout()
    {

        Auth::logout();
       
        if (!Auth::check()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
    }
    

    


    // get the authenticated user method
    public function user(Request $request) {
        return new UserResource($request->user());
    }
}

