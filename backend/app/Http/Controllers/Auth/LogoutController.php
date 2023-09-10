<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();
        // dd($user->currentAccessToken());

        return response()->json([
            'user' => null
        ]);
    }
}
