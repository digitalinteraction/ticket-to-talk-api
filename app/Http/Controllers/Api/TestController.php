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
}
