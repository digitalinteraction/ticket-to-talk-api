<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     * FROM: https://gist.github.com/tannernelson/cb2d981a3cfeabd425b8
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
//        return parent::render($request, $e);

        if($e instanceof HttpException) {
            $message = $e->getMessage();
            $code = $e->getStatusCode();
            if ($message == '') {
                switch($code) {
                    case 401:
                        $message = 'Invalid authorization';
                        break;
                    case 403:
                        $message = 'Insufficient authorization';
                        break;
                    case 404:
                        $message = 'Resource not found';
                        break;
                    case 405:
                        $message = 'Method ' . $request->method() . ' is not supported on this route';
                        break;
                    case 503:
                        $message = 'Be right back';
                        break;
                    default:
                        $message = 'Something went wrong';
                }
            }
            return response()->json([
                'message' => $message,
                'error' => true
            ], $code);
        } else {
            $response = [
                'message' => 'Something went wrong',
                'error' => true,
            ];
            if (debug()) {
                $response['debug'] = [
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ];
            }
            return response()->json($response, 500);
        }
    }
}
