<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

use App\User;

class AuthController extends Controller
{
    private $user;
    private $jwtauth;

    public function  __construct(User $user, JWTAuth $jwtauth)
    {
        $this->user = $user;
        $this->jwtauth = $jwtauth;
    }

    public function register(RegisterRequest $request)
    {
        $newUser = $this->user->create(
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password'))
            ]
        );

        if (!$newUser) {
            return response()->json(
                [
                    'failed_to_create_new_user'
                ]
            );
        }

        return response()->json(
            [
                'message' => 'user_created',
                'token' => $this->jwtauth->fromUser($newUser)
            ]
        );
    }

    public function login(LoginRequest $request)
    {
        // get user credentials
        $credentials = $request->only('email', 'password');
        $token = null;

        try
        {
            $token = $this->jwtauth->attempt($credentials);
            if (!$token)
            {
                return response()->json(
                    [
                        'invalid email or password'
                    ],
                    422
                );
            }
        }
        catch (JWTException $e)
        {
            return response()->json(
                [
                    'failed to create token'
                ],
                500
            );
        }

        return response()->json(compact('token'));
    }
}
