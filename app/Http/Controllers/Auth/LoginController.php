<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credenciales = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credenciales)) {
            return response()->json(['error' => 'Invalid Credencials'], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json(compact('user', 'token'), 200);
    }
}
