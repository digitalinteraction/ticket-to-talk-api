<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;

class TestController extends Controller
{
    public function getTag()
    {
        $tag = Tag::find(1);
        return response()->json($tag);
    }

    public function receiveImage(Request $request)
    {
        $data = base64_decode($request->image);
//        $img = imagecreatefromstring($data);
        $file = fopen("image.jpg", "wb");
        fwrite($file, $data);
        fclose($file);
//        return $img;
//        header('Content-Type: image/jpeg');
//        imagejpeg($img);
//        imagedestroy($img);
    }
}
