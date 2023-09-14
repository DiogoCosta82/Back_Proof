<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;

            return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'identifiant' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'type' => 'required|string',
            'entreprise' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'identifiant' => $request->identifiant,
            'email' => $request->email,
            'type' => $request->type,
            'entreprise' => $request->entreprise,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        $token = $user->createToken('MyApp')->accessToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    // Autres méthodes (updateProfile, logout, refresh, destroy) restent inchangées...




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
    public function updateProfile(Request $request)
    {
        $request->validate([
            'identifiant' => 'required|string|unique:users,identifiant,' . Auth::user()->id,
            'email' => 'required|string|email|unique:users,email,' . Auth::user()->id,
            'type' => 'required|string|unique:users,type,' . Auth::user()->id,
            'entreprise' => 'required|string|unique:users,entreprise,' . Auth::user()->id,
            'password' => 'required|string',
        ]);

        $update = User::find(Auth::user()->id);
        $update->identifiant = $request->input('identifiant');
        $update->email = $request->input('email');
        $update->type = $request->input('type');
        $update->entreprise = $request->input('entreprise');
        $update->password = Hash::make($request->input('password'));
        $update->save();

        // Déconnectez l'utilisateur pour invalider l'ancien token
        Auth::logout();

        // Connectez l'utilisateur avec les nouvelles informations
        Auth::login($update);

        // Générez un nouveau token pour l'utilisateur
        $token = Auth::user()->createToken('MyApp')->accessToken;

        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }


    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function destroy()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
