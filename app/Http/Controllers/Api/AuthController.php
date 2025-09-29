<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|confirmed',
            'crm'=>'nullable|string|max:50'
        ]);

        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'crm'=>$data['crm'] ?? null,
            'password'=>Hash::make($data['password'])
        ]);

        $token = $user->createToken('api_token')->accessToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais inválidas.']
            ]);
        }

        $token = $user->createToken('api_token')->accessToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message'=>'Logged out']);
    }
}
