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
        Request::setTrustedProxies(
            [
                '172.18.0.1',
                '128.240.212.41'
            ]
    );

        $log = new Log();
        $log->ip = $request->ip();
        $log->method = $request->method();
        $log->route = $request->path();
        $log->user_agent = $request->header('user-agent');
        $log->api_key = Input::get('api_key');

        if (strcmp("GET", $log->method) == 0)
        {
            $arr = Input::get();

            $get_vals = http_build_query($arr, '', ', ');
            $get_vals = urldecode($get_vals);

            $log->get_vals = $get_vals;
        }

        $log->save();

        return $next($request);
    }
}
