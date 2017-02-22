<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\JWTAuth;

class MediaController extends Controller
{

    private $user;
    private $jwtauth;

    public function  __construct(User $user, JWTAuth $jwtauth)
    {
        $this->user = $user;
        $this->jwtauth = $jwtauth;
    }

    //
    /**
     * TODO check user has access to the media, currently open to all...
     *
     * @api {get} /media/get Download Media
     * @apiName GetMedia
     * @apiGroup Media
     *
     * @apiParam {String} fileName Path to the file.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {File} Returns the requested file
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
     */
    public function getMedia()
    {

        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated."
                ]
            );
        }

        $fileName = Input::get("fileName");

        $media_type = explode('_', $fileName)[0];
        switch ($media_type)
        {
            case ('t'):

                break;
            case ('u'):
                break;
            case ('p'):
                break;
        }


        $file_suffix = strstr($fileName, '.');
        $file_type = '';

        switch ($file_suffix)
        {
            case ('.jpg') :

                $file_type = 'image/jpeg';
                break;
            case ('.wav') :

                $file_type = 'audio/wav';
                break;
        }

        $exists = Storage::disk('s3')->exists($fileName);
        if ($exists)
        {
            // FROM: https://laracasts.com/discuss/channels/laravel/download-file-from-cloud-disk-s3-with-laravel-51
            $file_contents = Storage::disk('s3')->get($fileName);

            $response = response($file_contents, 200, [
                'Content-Type' => $file_type,
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename={$fileName}",
                'Content-Transfer-Encoding' => 'binary',
            ]);

            ob_end_clean(); // <- this is important, i have forgotten why.

            return $response;
        }
    }
}
