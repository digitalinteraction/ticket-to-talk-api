<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

use App\User;

class AuthController extends Controller
{
    private $user;
    private $jwtauth;

    private $default_api_key = "a82ae536fc32c8c185920f3a440b0984bb51b9077517a6c8ce4880e41737438d";

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

        $newUser = $this->user->create(
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password'))
            ]
        );

        if ($request->pathToPhoto != null)
        {
            $newUser->pathToPhoto = $request->pathToPhoto;
        }
        else
        {

            $data = base64_decode($request->image);
            $file_path = "ticket_to_talk/storage/profile/u_" . $newUser->id .".jpg";

            Storage::disk('s3')->put($file_path, $data);

            $newUser->pathToPhoto = $file_path;
            $newUser->imageHash = $request->imageHash;
        }

        $raw_key = $this->default_api_key . $newUser->email . time();
        $api_key = hash('sha256', $raw_key);
        $newUser->api_key = $api_key;
//        $newUser->api_key = bin2hex(openssl_random_pseudo_bytes(32));

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
                'api_key' => $api_key,
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
        // get user credentials
        $credentials = $request->only('email', 'password');
        $val = null;

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

        $user = $this->jwtauth->authenticate($val);

        // If login attempted with default api key (logged in on new device)
        // Send their api key.
        if (strcmp($request->api_key, $this->default_api_key) == 0)
        {

            if($user->revoked)
            {
                return response()->json(
                    [
                        "code" => "401",
                        "message" => "API Key revoked",
                        "user" => $user,
                        "token" => $val
                    ]
                );
            }

            return response()->json(
                [
                    "code" => "200",
                    "message" => "Authenticated",
                    "user" => $user,
                    "api_key" => $user->api_key,
                    "token" => $val
                ]
            );
        }

        return response()->json(
            [
                "code" => "200",
                "message" => "Authenticated",
                "user" => $user,
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
