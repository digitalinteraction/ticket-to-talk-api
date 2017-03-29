<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\JWTAuth;

class TagController extends Controller
{

    private $user;
    private $jwtauth;

    public function  __construct(User $user, JWTAuth $jwtauth)
    {
        $this->user = $user;
        $this->jwtauth = $jwtauth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * TODO Check tag already exists.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            abort(401);
        }
        $tag = new Tag();
        $tag->text = $request->text;
        $stored = $tag->checkForExistingTag();
        if ($stored)
        {
            $user->tags()->attach($stored->id);

            return response()->json(
                [
                    "status" =>
                    [
                        "message" => "tag saved",
                        "code" => 200
                    ],
                    "errors" => false,
                    "data" =>
                    [
                        "tag" => $stored,
                        'owner' => $user
                    ]
                ]
            );
        } else
        {
            $tag->save();
            $user->tags()->attach($tag->id);

            return response()->json(
                [
                    "status" =>
                    [
                        "message" => "success",
                        "code" => 200
                    ],
                    "errors" => false,
                    "data" =>
                    [
                        "tag" => $tag,
                        'owner' => $user
                    ]
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            abort(401);
        }

        $tagID = (int) Input::get('tag_id');
        foreach($user->tags as $tag)
        {
            if ($tagID ==  $tag->id)
            {

                return response()->json(
                    [
                        "status" =>
                        [
                            "message" => "tag found",
                            "code" => 200
                        ],
                        "errors" => false,
                        "data" =>
                        [
                            "tag" => $tag
                        ]
                    ]
                );
            }
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            abort(401);
        }

        $tagID = (int) Input::get('tag_id');
        $found = false;
        $tag = null;
        foreach($user->tags as $user_tags)
        {
            if ($tagID ==  $user_tags->id)
            {
                $tag = $user_tags;
                $found = true;
            }
        }

        if(!$found)
        {
            abort(404);
        }

        $tag->text = $request->text;
        $tag->save();

        return response()->json(
            [
                "status" =>
                [
                    "message" => "tag updated",
                    "code" => 200
                ],
                "errors" => false,
                "data" =>
                [
                    "tag" => $tag
                ]
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            abort(401);
        }

        $tagID = (int) Input::get('tag_id');
        $found = false;
        $tag = null;
        foreach($user->tags as $user_tags)
        {
            if ($tagID ==  $user_tags->id)
            {
                $tag = $user_tags;
                $found = true;
            }
        }

        if(!$found)
        {
            abort(404);
        }

        $tag->delete();

        return response()->json(
            [
                "status" =>
                [
                    "message" => "tag deleted",
                    "code" => 200
                ],
                "errors" => false,
                "data" =>
                [

                ]
            ]
        );
    }

    public function getUserTags()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            abort(401);
        }

        return response()->json(
            [
                "status" =>
                [
                    "message" => "success",
                    "code" => 200
                ],
                "errors" => false,
                "data" =>
                [
                    "tags" => $user->tags
                ]
            ]
        );
    }
}
