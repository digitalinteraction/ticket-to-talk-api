<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Support\Facades\Input;

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
        $file = fopen("storage/photo/p1_t3.jpg", "wb");
        fwrite($file, $data);
        fclose($file);

        return response()->json(
            [
                "Status" => 200
            ]
        );
//        return $img;
//        header('Content-Type: image/jpeg');
//        imagejpeg($img);
//        imagedestroy($img);
    }

    public function getImage()
    {
        $path = Input::get("path");
        return response()->file($path);
        $ticket_id = Input::get("ticket_id");
        $file = file_get_contents("storage/photo/t_" . $ticket_id . ".jpg");
        $byte_arr = str_split($file);
        foreach ($byte_arr as $key => $val)
        {
            $byte_arr[$key] = ord($val);
        }
        return response()->json(["image_bytes" => $byte_arr]);
    }

    public function receiveAudio(Request $request)
    {
        $data = base64_decode($request->audio);
        $file = fopen("storage/audio/sample.wav", "wb");
        fwrite($file, $data);
        fclose($file);

        return response()->json([200]);
    }

    public function getImageBytes()
    {
        $fileName = Input::get("fileName");

        return response()->file("storage/photo/" . $fileName);

        $file = file_get_contents("storage/photo/" . $fileName);
        $bytes = str_split($file);
        foreach ($bytes as $key => $val)
        {
            $bytes[$key] = ord($val);
        }

        return response()->json(
            [
                "bytes" => $bytes
            ]
        );
    }

    public function writeTextToFile()
    {

        $path = public_path('storage/test.txt');
        $file = fopen($path, "w");
        echo fwrite($file, "Hello world!");
        fclose($file);
    }
}
