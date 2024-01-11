<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'age' => $request->age,
            'birthday' => $request->birthday
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Register Success',
            'user' => $user,
            'token' => $token
        ]);
    }
}
