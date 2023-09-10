<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'role' => $request->role == null ? 0 : $request->role,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'User Created',
            'User' => [
                'role' => $user->role,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email
            ]
        ]);
    }
}
