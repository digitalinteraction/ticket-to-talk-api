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
     * @api {post} /articles/store Store an Article
     * @apiName StoreArticle
     * @apiGroup Articles
     *
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     * @apiSuccess {Article} article The stored article
     * @apiSuccess {User} user Owner of the article
     *
     * @apiError 500 The article could not be found.
     * @apiError 401 User could not be authenticated.
     */
    public function store(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
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
     * @api {get} /articles/show Get an Article
     * @apiName ShowArticle
     * @apiGroup Articles
     *
     * @apiParam {int} article_id The article ID
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     * @apiSuccess {Article} article The requested article
     *
     * @apiError 500 The article could not be found.
     * @apiError 401 User could not be authenticated.
     */
    public function show()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
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
     * @api {post} /articles/update Update an Article
     * @apiName UpdateArticle
     * @apiGroup Articles
     *
     * @apiParam {int} article_id The article id
     * @apiParam {String} title The article title
     * @apiParam {String} link The article title
     * @apiParam {Notes} notes The user's notes on the article
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     * @apiSuccess {Article} article The requested article
     *
     * @apiError 500 The article could not be found.
     * @apiError 401 User could not be authenticated.
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
                    "Status" => 401,
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
     * @api {get} /articles/destroy Delete an Article
     * @apiName DeleteArticle
     * @apiGroup Articles
     *
     * @apiParam {int} article_id The article id
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     *
     * @apiError 500 The article could not be found.
     * @apiError 401 User could not be authenticated.
     */
    public function destroy()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
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
     * Gets all of the user's articles.
     *
     * @api {get} /articles/all Get User's Articles
     * @apiName GetUserArticles
     * @apiGroup Articles
     *
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     * @apiSuccess {Article[]} articles User's articles
     *
     * @apiError 500 The article could not be found.
     * @apiError 401 User could not be authenticated.
     */
    public function getUserArticles()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
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
     * @api {post} /articles/share/send Share an Article.
     * @apiName ShareArticle
     * @apiGroup Articles
     *
     * @apiParam {int} article_id The article id
     * @apiParam {string} email The recipient's email address.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     *
     * @apiError 500 The article could not be found.
     * @apiError 401 User could not be authenticated.
     */
    public function shareArticle(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
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

        if (strcmp($request->includeNotes, "False") == 0)
        {
            $a = new Article();
            $a->title = $article->title;
            $a->link = $article->link;
            $a->notes = " ";
            $a->save();
            $article = $a;
        }

        $recipient->sharedArticles()->attach($article->id, ["sender_id" => $user->id]);

        return response()->json(
            [
                "Status" => 200,
                "Message" => "Invitation sent"
            ]
        );

    }

    /**
     * Get all articles shared with the user
     *
     * @api {get} /articles/share/get Get Shared Articles
     * @apiName GetSharedArticle
     * @apiGroup Articles
     *
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {Article[]} Articles Articles shared with the user.
     *
     * @apiError 500 The article could not be found.
     * @apiError 401 User could not be authenticated.
     */
    public function getSharedArticles()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
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
     * @api {post} /articles/share/accept Accept an Article.
     * @apiName AcceptArticle
     * @apiGroup Articles
     *
     * @apiParam {int} article_id The article id
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     * @apiSuccess {Article[]} The user's articles
     *
     * @apiError 500 The article could not be found.
     * @apiError 401 User could not be authenticated.
     */
    public function acceptArticle(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
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
     * @api {post} /articles/share/reject Reject an Article.
     * @apiName RejectArticle
     * @apiGroup Articles
     *
     * @apiParam {int} article_id The article id
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     *
     * @apiError 500 The article could not be found.
     * @apiError 401 User could not be authenticated.
     */
    public function rejectArticle(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $user->sharedArticles()->detach($request->article_id);

        return response()->json(
            [
                "Status" => 200,
                "Message" => "Article rejected",
            ]
        );
    }
}
