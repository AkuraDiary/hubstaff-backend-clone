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

        return response()->json(array_merge($user->toArray(), ['auth-token' => $token]));
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = User::where('username', $request->username)->first();

            $request->session()->regenerate();
            $token = $user->createToken('auth-token')->plainTextToken;
            Auth::user()->token = $token;

            return response()->json(Auth::user(), 200);
        }

        return null;
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        return response()->json(['status' => 200]);
    }
}
