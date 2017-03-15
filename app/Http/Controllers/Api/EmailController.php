<?php

namespace App\Http\Controllers\Api;

use App\Limited;
use App\RateLimited;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public static function rateEmail(Request $request)
    {
        // set email params
        $data =
            [
                'ip' => $request->ip(),
                'api_key' => Input::get('api_key'),
                'route' => $request->path(),
            ];

        Mail::send('emails.rate', $data, function($message){
            $message->to('d.welsh@ncl.ac.uk')->subject('[ttt-api] User Rate Limited');
        });

        $limited = new Limited();
        $limited->ip = $request->ip();
        $limited->method = $request->method();
        $limited->api_key = Input::get('api_key');
        $limited->user_agent = $request->header('user-agent');
        $limited->path = $request->path();

        $limited->save();
    }
}
