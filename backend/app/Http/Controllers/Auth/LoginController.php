<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (!Auth::attempt($data)) {
            return response([
                'errors' => 'Invalid Credentials'
            ], 422);
        }

        $user = Auth::user();

        return response()->json([
            'message' => 'Welcome',
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ]);
    }
}
