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

        $articleID = (int) $request->article_id;
        $article = $user->articles()->find($articleID);

        if(!$article)
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

        $article = $user->articles()->find(Input::get("article_id"));
        $user->articles()->detach($article->id);

        return response()->json(
            [
                "status" => 200,
                "message" => "Article deleted",
            ]
        );
    }

    /**
     * Gets all of the user's articles
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Share an article with a user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function shareArticle(Request $request)
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

        $article = Article::find($request->article_id);
        $recipient = User::where('email', $request->email)->get()->first();

        if(!$recipient)
        {
            return response()->json(
                [
                    "Status" => 500,
                    "Message" => "The recipient is not registered with Ticket to Talk",
                ]
            );
        }
        else
        {
            $recipient->sharedArticles()->attach($article->id, ["sender_id" => $user->id]);

            return response()->json(
                [
                    "Status" => 200,
                    "Message" => "Invitation sent"
                ]
            );
        }
    }

    /**
     * Get all articles shared with the user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSharedArticles()
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

        $articles = [];

        foreach ($user->sharedArticles as $article)
        {
            array_push($articles, $article);
        }

        return response()->json(
            [
                "Status" => 200,
                "Articles" => $articles
            ]
        );
    }

    /**
     * Accept an article
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptArticle(Request $request)
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

        $user->articles()->attach($request->article_id);

        $user->sharedArticles()->detach($request->article_id);

        return response()->json(
            [
                "Status" => 200,
                "Message" => "Article accepted",
                "Articles" => $user->articles
            ]
        );
    }

    /**
     * Reject a shared article.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function rejectArticle()
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
    }
}
