<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

use App\User;
use Tymon\JWTAuth\Token;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $user;
    private $jwtauth;

    public function  __construct(User $user, JWTAuth $jwtauth)
    {
        $this->user = $user;
        $this->jwtauth = $jwtauth;
    }

    /**
     * Registers the user.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {

//        return response()->json(
//            [
//                "Request" => $request->password
//            ]
//        );
        $newUser = $this->user->create(
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password'))
            ]
        );

        $file_path = "storage/profile/u_" . $newUser->id .".jpg";
        $data = base64_decode($request->image);
        $file = fopen($file_path, "wb");
        fwrite($file, $data);
        fclose($file);
        $newUser->pathToPhoto = $file_path;
        $newUser->save();

        if (!$newUser) {
            return response()->json(
                [
                    'failed_to_create_new_user'
                ],500
            );
        }

        return response()->json(
            [
                'message' => 'user_created',
                'user' => $newUser,
                'token' => $this->jwtauth->fromUser($newUser)
            ]
        );
    }

    /**
     * Authenticates the user
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
//        return $request->getContent();
        // get user credentials
        $credentials = $request->only('email', 'password');
        $val = null;
//        return $request->email;

        try
        {
            $val = $this->jwtauth->attempt($credentials);
            if (!$val)
            {
                return response()->json(
                    [
                        "code" => "401",
                        "message" => 'Invalid email or password'
                    ]
                );
            }
        }
        catch (JWTException $e)
        {
            return response()->json(
                [
                    "code" => "500",
                    "message" => 'Failed to create token'
                ]
            );
        }

        return response()->json(
            [
                "code" => "200",
                "message" => "Authenticated",
                "user" => $this->jwtauth->authenticate($val),
                "token" => $val
            ]
        );
    }

    /**
     * Generates the user from the token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);
        return response()->json($user);
    }
}
