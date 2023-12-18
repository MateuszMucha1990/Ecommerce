<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=> ['required', 'email'],
            'password' => 'required',
            'remember' => 'boolean'
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);
        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'message' => 'Email or password is incorrect'
            ], 422);
        }

         /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->is_admin) {
            Auth::logout();
            return response([
                'message' => 'You don\'t have permission to authenticate as admin'
            ], 403);
        }
        $token = $user->createToken('main')->plainTextToken;   //Laravel Sanctum for Tokens

        return response([
            'user'=>new UserResource($user),
            'token'=>$token
        ]);
    }



    public function logout(Request $request)
    {
        /** @var \App\Models\User $user */

        $user = Auth::user();
       // $user->currentAccessToken()->delete();
        $request->user()->currentAccessToken()->delete();

        return response('', 204);
    }


    public function getUser(Request $request)
    {
        return new UserResource($request->user());
    }
}
