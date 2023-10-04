<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    // register a new user method
    public function register(Request $request)
{
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'type_user' => 'required|string|in:Admin,User',
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
    public function login(LoginRequest $request) {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Email or password is incorrect!'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token, // Envoyez le token dans la réponse JSON
        ]);
    }

    // // logout a user method
    // public function logout(Request $request) {
    //     if ($request->user()) {
    //     // Supprimez le jeton d'accès actuel de l'utilisateur
    //         $request->user()->currentAccessToken()->delete();

    //         return response()->json([
    //             'message' => 'Logged out successfully!'
    //         ]);
    //     }

    //     return response()->json([
    //      'message' => 'User not authenticated!'
    //     ], 401);
    // }


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

