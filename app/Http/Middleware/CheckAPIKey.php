<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class CheckAPIKey
{

    private $user;
    private $jwtauth;

    public function  __construct(User $user, JWTAuth $jwtauth)
    {
        $this->user = $user;
        $this->jwtauth = $jwtauth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $token = Input::get('token');
        $user = null;

        try
        {
            $user = $this->jwtauth->authenticate($token);
        }
        catch (JWTException $e)
        {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated."
                ],401
            );
        }


        if (!$user || $user->revoked)
        {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated."
                ]
            );
        }

        if (!$user->verified)
        {
          return response()->json(
            [
              'status' => 403,
              'errors' => true,
              'message' => 'Account not verified.'
            ],403
          );
        }

        if (strcmp($user->api_key, Input::get('api_key')) == 0)
        {
            return $next($request);
        }
        else
        {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "Incorrect API Key."
                ]
            );
        }
    }
}
