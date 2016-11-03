<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\EmailController;
use Closure;
use Illuminate\Routing\Middleware\ThrottleRequests;

/**
 * Extends laravel throttle to send an email notification when limiting.
 *
 * Class RateLimiter
 * @package App\Http\Middleware
 */
class RateLimiter extends ThrottleRequests
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param int $maxAttempts
     * @param int $decayMinutes
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next, $maxAttempts = 60, $decayMinutes = 1)
    {
        $key = $this->resolveRequestSignature($request);

        if ($this->limiter->tooManyAttempts($key, $maxAttempts, $decayMinutes)) {

            // Send notification email and log the rate
            EmailController::rateEmail($request);
            return $this->buildResponse($key, $maxAttempts);
        }

        $this->limiter->hit($key, $decayMinutes);

        $response = $next($request);

        return $this->addHeaders(
            $response, $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts)
        );
    }
}
