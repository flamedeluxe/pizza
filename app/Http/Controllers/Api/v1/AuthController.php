<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function init()
    {

        return response()->json(Auth::user());
    }

    /**
     * Login user.
     *
     * @param Request $request
     * @return \App\Models\User
     */
    public function register(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'email' => ['required', 'email:rfc'],
                'password' => ['required'],
                'password_repeat' => ['required', 'same:password']
            ]
        );

        $user = User::where('email', $request->input('email'))->first();

        if(is_object($user)) return response()->json([
            'status' => false,
            'errors' => 'User with this email already exist'
        ])->setStatusCode('419');

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ])->setStatusCode('419');
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
        $token = $user->createToken('token-name');

        return response()->json(compact(['user', 'token']))->setStatusCode('200');
    }

    /**
     * Login user.
     *
     * @param Request $request
     * @return \App\Models\User
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 419);
        }

        $user = User::where('email', $request->input('email'))->first();
        $token = $user->createToken('token-name');

        return response()->json([
            'status' => true,
            'user' => Auth::id(),
            'message' => 'You are logged',
            'token' => $token
        ], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return true;
    }
}
