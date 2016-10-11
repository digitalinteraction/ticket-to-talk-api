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

//        $path = public_path($fileName);
//        return response()->download($path);

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
