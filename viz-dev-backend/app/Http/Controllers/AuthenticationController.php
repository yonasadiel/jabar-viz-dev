<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public static function me(Request $request) {
        $user = Auth::user();
        return response($user->toJson(), 200);
    }

    public static function login(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response($user->toJson(), 200);
        } else {
            return response([
                'code' => 'WRONG_CREDENTIAL',
                'message' => 'Wrong username / password',
            ], 400);
        }
    }
}
