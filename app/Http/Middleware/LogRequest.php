<?php

namespace App\Http\Middleware;

use App\Http\Requests\Request;
use App\Log;
use Closure;
use Illuminate\Support\Facades\Input;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Request::setTrustedProxies([
                '172.18.0.1',
                '128.240.212.41'
            ]
        );

        // Anonymise IP address
        $ip = explode(".", $request->ip());
        $ip[3] = 0;
        $ip_anon = implode(".", $ip);

        $log = new Log();
        $log->ip = $ip_anon;
        $log->method = $request->method();
        $log->route = $request->path();
        $log->user_agent = $request->header('user-agent');

        $log->save();

        return $next($request);
    }
}
