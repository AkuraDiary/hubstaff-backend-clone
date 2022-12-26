<?php

namespace App\Http\Controllers\Auth;

use App\Domain\IAM\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json(['data' => array_merge($user->toArray(), ['auth-token' => $token]), 'status' => 200]);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Wrong username or password', 'status' => 404]);
        }

        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json(['data' => array_merge($user->toArray(), ['auth-token' => $token]), 'status' => 401]);
    }

    public function logout(Request $request) 
    {
        Auth::user()->tokens()->delete();
        return response()->json(['status' => 200]);
    }
}
