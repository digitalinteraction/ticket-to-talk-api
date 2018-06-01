<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;
use App\User;

class CheckConsent
{
    private $user;
    private $jwtauth;

    public function __construct(User $user, JWTAuth $jwtauth)
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

        try {
            $user = $this->jwtauth->authenticate($token);
        } catch (JWTException $e) {
            return response()->json(
              [
                  "status" => 401,
                  "errors" => true,
                  "message" => "User not authenticated."
              ], 401
          );
        }
        // Check user has accepted the terms and conditions before allowing access to API routes.
        $consent = $user->consents()->first();
        if ($consent == null) {
            return response()->json([
                "status" => 403,
                "errors" => true,
                "message" => "User has not consented to terms & conditions."
            ]);
        }

        if (!$consent->core) {
            return response()->json([
                "status" => 403,
                "errors" => true,
                "message" => "User has not consented to terms & conditions."
            ]);
        }

        return $next($request);
    }
}
