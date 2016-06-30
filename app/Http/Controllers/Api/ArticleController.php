<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\JWTAuth;

class ArticleController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 402,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $article = new Article();
        $article->title = $request->title;
        $article->link = $request->link;
        $article->notes = $request->notes;
        $saved = $article->save();
        $article->users()->attach($user->id);

        if ($saved) {
            return response()->json(
                [
                    "status" => 200,
                    "message" => "Article saved",
                    "article" => $article,
                    'owner' => $user
                ]
            );
        } else
        {
            return response()->json(
                [
                    "status" => 500,
                    "message" => "Error saving article",
                    "article" => $article
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
            return response()->json(
                [
                    "Status" => 402,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $articleID = (int) Input::get('article_id');

        foreach($user->articles as $article)
        {
            if ($articleID ==  $article->id)
            {
                return response()->json(
                    [
                        "status" => 200,
                        "message" => "Article Found",
                        "article" => $article,
                    ]
                );
            }
        }
        return response()->json(
            [
                "status" => 500,
                "message" => "Article not found",
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
            return response()->json(
                [
                    "Status" => 402,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $articleID = (int) Input::get('article_id');
        $found = false;
        $article = null;
        foreach($user->articles as $user_articles)
        {
            if ($articleID ==  $user_articles->id)
            {
                $article = $user_articles;
                $found = true;
            }
        }

        if(!$found)
        {
            return response()->json(
                [
                    "status" => 500,
                    "message" => "Article not found",
                ]
            );
        }

        $article->title = $request->title;
        $article->link = $request->link;
        $article->notes = $request->notes;
        $article->save();

        return response()->json(
            [
                "status" => 200,
                "message" => "Article updated",
                "article" => $article,
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
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 402,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $articleID = (int) Input::get('article_id');
        $found = false;
        $article = null;
        foreach($user->articles as $user_articles)
        {
            if ($articleID ==  $user_articles->id)
            {
                $article = $user_articles;
                $found = true;
            }
        }

        if(!$found)
        {
            return response()->json(
                [
                    "status" => 500,
                    "message" => "Article not found",
                ]
            );
        }

        $article->delete();
        return response()->json(
            [
                "status" => 200,
                "message" => "Article deleted",
            ]
        );
    }

    public function getUserArticles()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 402,
                    "Message" => "User not authenticated.",
                ]
            );
        }
        return response()->json(
            [
                "status" => 200,
                "message" => "All user articles",
                "articles" => $user->articles
            ]
        );
    }
}
