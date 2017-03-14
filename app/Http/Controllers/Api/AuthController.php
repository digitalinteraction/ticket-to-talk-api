<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;


use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

use App\User;
use Carbon\Carbon;
use App\Registration;

class AuthController extends Controller
{
    private $user;
    private $jwtauth;

    private $default_api_key = "a82ae536fc32c8c185920f3a440b0984bb51b9077517a6c8ce4880e41737438d";

    public function __construct(User $user, JWTAuth $jwtauth)
    {
        $this->user = $user;
        $this->jwtauth = $jwtauth;
    }

    /**
     * Registers the user.
     *
     * @api {post} /auth/register Register
     * @apiName Register
     * @apiGroup Authentication
     *
     * @apiParam {String} name The user's name.
     * @apiParam {String} email The user's email address.
     * @apiParam {String} password A hashed version of the user's password.
     * @apiParam {String} pathToPhoto Path to the user's photo.
     * @apiParam {byte[]} image The user's profile picture as a byte array.
     * @apiParam {String} imageHash A SHA256 of the image byte array.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} message Server message
     * @apiSuccess {User} user The newly created user.
     * @apiSuccess {String} api_key The user's api_key
     * @apiSuccess {String} token The user's session token.
     *
     * @apiError 500 User could not be created.
     */
    public function register(RegisterRequest $request)
    {
        try {
            $newUser = $this->user->create(
                [
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt($request->get('password'))
                ]
            );
        } catch (QueryException $ex) {
            return response()->json(
                [
                    'message' => [
                        'status' => '500'
                    ],
                    'errors' => [
                        'This email is already registered with Ticket to Talk'
                    ],
                    'data' => []
                ], 500
            );
        }


        if ($request->pathToPhoto != null) {
            $newUser->pathToPhoto = $request->pathToPhoto;
        } else {
            $data = base64_decode($request->image);
            $file_path = "ticket_to_talk/storage/profile/u_" . $newUser->id . ".jpg";

            Storage::disk('s3')->put($file_path, $data);

            $newUser->pathToPhoto = $file_path;
            $newUser->imageHash = $request->imageHash;
        }

        $raw_key = $this->default_api_key . $newUser->email . time();
        $api_key = hash('sha256', $raw_key);
        $newUser->api_key = $api_key;
        $newUser->verified = false;

        $newUser->save();

        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= chr(rand(65, 90));
        }

        $registration = new Registration();
        $registration->code = $code;
        $registration->user_id = $newUser->id;

        $registration->save();

        $data =
            [
                'name' => $newUser->name,
                'code' => $registration->code,
                'email' => $newUser->email
            ];

        $email = $newUser->email;

        Mail::send('emails.register', $data, function ($message) use ($email) {
            $message->to($email)->subject('Verify your email address');
        });

        return response()->json(
            [
                'message' => [
                    "User created."
                ],
                'errors' => [],
                'data' => [
                    'user' => $newUser,
                    'api_key' => $api_key,
                    'token' => $this->jwtauth->fromUser($newUser)
                ],
            ]
        );
    }

    /**
     * Authenticates the user
     *
     * @api {post} /auth/login Login
     * @apiName Login
     * @apiGroup Authentication
     *
     * @apiParam {String} email The user's email address.
     * @apiParam {String} password A hashed version of the user's password.
     *
     * @apiSuccess {String} message Server message
     * @apiSuccess {User} user The newly created user.
     * @apiSuccess {JWTAuthToken} token The session token
     * @apiSuccess {String} api_key Returns the user's api key if they login with the default key.
     *
     * @apiError 401 User could not be authenticated
     */
    public function login(LoginRequest $request)
    {
        // get user credentials
        $credentials = $request->only('email', 'password');
        $val = null;

        try {
            $val = $this->jwtauth->attempt($credentials);
            if (!$val) {
                return response()->json(
                    [
                        'status' => [
                            'message' => "Incorrect email or password",
                            'code' => 401
                        ],
                        'errors' => [
                            "message" => "Incorrect authentication details"
                        ],
                        'data' => [
                        ], 401
                    ]
                );
            }
        } catch (JWTException $e) {
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
        if (strcmp($request->api_key, $this->default_api_key) == 0) {
            if ($user->revoked) {
                return response()->json(
                    [
                        "code" => "401",
                        "message" => "error",
                        "user" => $user,
                        "token" => $val
                    ], 500
                );
            }

            return response()->json(
                [
                    'status' => [
                        'message' => "success",
                        'code' => 200
                    ],
                    'errors' => [],
                    'data' => [
                        "user" => $user,
                        "token" => $val,
                        "api_key" => $user->api_key
                    ],
                ]
            );
        } elseif ($request->api_key == null) {
            return response()->json(
                [
                    'status' => [
                        'message' => "error",
                        'code' => 401
                    ],
                    'errors' =>
                        [
                            'No API key given'
                        ],
                    'data' => [
                    ],
                    401
                ]
            );
        } elseif (strcmp($request->api_key, $user->api_key) == 0) {
            return response()->json(
                [
                    'status' => [
                        'message' => "success",
                        'code' => 200
                    ],
                    'errors' => [],
                    'data' => [
                        "user" => $user,
                        "token" => $val
                    ],
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => [
                        'message' => "error",
                        'code' => 401
                    ],
                    'errors' =>
                        [
                            'Invalid API key'
                        ],
                    'data' => [
                    ]
                ], 401
            );
        }
    }

    public function verify(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user) {
            return response()->json(
                [
                    "Status" => 401,
                    'errors' => true,
                    "Message" => "User not authenticated."
                ], 401
            );
        }

        if ($user->verified) {
            return response()->json(
                [
                    'status' => 501,
                    'errors' => true,
                    'message' => 'Not implemented'
                ], 501
            );
        }

        $code = $request->code;
        $found = false;

        foreach ($user->registrations as $reg) {
            if ($reg->code == $code) {
                $diff = $reg->created_at->diffInDays(Carbon::now());
                if ($diff <= 7) {
                    $user->verified = true;
                    $user->save();
                    return response()->json(
                        [
                            'status' => 200,
                            'errors' => false,
                            'message' => 'verified',
                            'data' =>
                                [
                                    'verified' => true
                                ]
                        ]
                    );
                } else {
                    return response()->json(
                        [
                            'status' => 400,
                            'errors' => true,
                            'message' => 'Registration code has expired.'
                        ], 400
                    );
                }
            }
        }
        if (!$found) {
            return response()->json(
                [
                    'status' => 501,
                    'errors' => true,
                    'message' => 'Registration code does not exist'
                ]
            );
        }
    }
}
