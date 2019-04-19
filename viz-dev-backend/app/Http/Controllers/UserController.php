<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public static function index(Request $reuqest) {
        return response(User::all(), 200);
    }

    public static function store(Request $request) {
        if (!$request->input('username')) {
            return response([
                'code' => 'USER_MISSING_USERNAME',
                'message' => 'Cannot save user due to missing username',
            ], 400);
        }

        if (!$request->input('email')) {
            return response([
                'code' => 'USER_MISSING_EMAIL',
                'message' => 'Cannot save user due to missing email',
            ], 400);
        }

        if (!$request->input('password')) {
            return response([
                'code' => 'USER_MISSING_PASSWORD',
                'message' => 'Cannot save user due to missing password',
            ], 400);
        }

        if (User::where('username', $request->input('username'))->count() > 0) {
            return response([
                'code' => 'USERNAME_ALREADY_TAKEN',
                'message' => 'Username has already taken',
            ], 400);
        }

        if (!Auth::user()->can_modify_users()) {
            return response([
                'code' => 'NOT_AUTHORIZED',
                'message' => 'Only admin can create new user',
            ], 401);
        }

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role') ? : User::ROLE_DINAS;
        $user->save();

        return response($user->toJson(), 201);
    }

    public static function update(Request $request, $id) {
        $user = User::find($id);
        if ($user) {
            if ($request->input('username') !== $user->username && User::where('username', $request->input('username'))->count() > 0) {
                return response([
                    'code' => 'USERNAME_ALREADY_TAKEN',
                    'message' => 'Username has already taken',
                ], 400);
            }

            $user->username = $request->input('username') ? : $user->username;
            $user->email = $request->input('email') ? : $user->email;
            $user->role = $request->input('role') ? : $user->role;
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();

            return $user;
        } else {
            return response([
                'code' => 'USER_NOT_FOUND',
                'message' => 'User requested is not found',
            ], 404);
        }
    }
}
