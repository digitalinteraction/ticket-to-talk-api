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
     * @apiDescription
     * Create and save an article
     *
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     * @apiSuccess {Article} article The stored article
     * @apiSuccess {User} user Owner of the article
     *
     * @apiSuccessExample {json} Success-Response:
     *
     *  {
            "status": {
                "message": "Article saved.",
                "code": 200
            },
            "errors": [],
            "data": {
                "article": {
                    "title": "Facebook",
                    "link": "facebook.com",
                    "notes": "These are notes",
                    "updated_at": "2016-10-21 10:23:22",
                    "created_at": "2016-10-21 10:23:22",
                    "id": 5
                },
                "owner": {
                    "id": 3,
                    "name": "Test",
                    "email": "test@email.com",
                    "pathToPhoto": "ticket_to_talk/storage/profile/u_3.jpg",
                    "created_at": "2016-10-20 15:16:03",
                    "updated_at": "2016-10-20 15:16:04",
                    "imageHash": "asdasdasdasdasdasdasdsdasdasd",
                    "revoked": null
                }
            }
        }
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
                    "status" =>
                        [
                            "message" => "Article saved.",
                            "code" => 200
                        ],
                    "errors" => [],
                    "data" =>
                        [
                            "article" => $article,
                            'owner' => $user
                        ]
                ]
            );
        } else
        {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Article could not be saved",
                            "code" => 500
                        ],
                    "errors" => [],
                    "data" => []
                ],500
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
     * @apiDescription
     * Get a single article by its ID.
     *
     * @apiParam {int} article_id The article ID
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     * @apiSuccess {Article} article The requested article
     *
     * @apiSuccessExample {json} Server-Response:
     *  {
            "status": {
                "message": "Returned users articles",
                "code": 200
            },
            "errors": [],
            "data": {
                "article": {
                    "id": 5,
                    "title": "Article",
                    "link": "http://google.com",
                    "notes": "These are updated notes",
                    "created_at": "2016-10-21 10:23:22",
                    "updated_at": "2016-10-21 10:28:46",
                    "pivot": {
                        "user_id": 3,
                        "article_id": 5
                    }
                }
            }
        }
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
                    "status" =>
                        [
                            "message" => "User could not be authenticated",
                            "code" => 401
                        ],
                    "errors" =>
                        [
                            'message' => "User could not be authenticated"
                        ],
                    "data" => []
                ],401
            );
        }

        $article = Article::find(Input::get('article_id'));

        if(!$article)
        {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Error",
                            "code" => 404
                        ],
                    "errors" =>
                        [
                            'message' => "Article could not be found"
                        ],
                    "data" =>
                        [

                        ]
                ],404
            );
        }

        if ($user->can('view', $article))
        {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Returned users article",
                            "code" => 200
                        ],
                    "errors" => [],
                    "data" =>
                        [
                            "article" => $article
                        ]
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "User not authorised for resource",
                            "code" => 403
                        ],
                    "errors" => [],
                    "data" => []
                ],403
            );
        }

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
     * @apiDescription
     * Update an article with new information.
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
     * @apiSuccessExample {json} Server-Response:
     *  {
            "status": {
                "message": "Article updated",
                "code": 200
            },
            "errors": [],
            "data": {
                "article": {
                    "id": 5,
                    "title": "Article",
                    "link": "http://google.com",
                    "notes": "These are updated notes",
                    "created_at": "2016-10-21 10:23:22",
                    "updated_at": "2016-10-21 10:28:46",
                    "pivot": {
                        "user_id": 3,
                        "article_id": 5
                    }
                }
            }
        }
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
                    'status' =>
                        [
                            "message" => "User not authenticated",
                            "code" => 401
                        ],
                    'errors' =>
                        [
                            'message' => "User could not be authenticated"
                        ],
                    'data' =>
                        [

                        ],
                ],401
            );
        }

        $article = Article::find($request->article_id);

        if(!$article)
        {
            return response()->json(
                [
                    'status' =>
                        [
                            "message" => "Resource not found",
                            "code" => 404
                        ],
                    'errors' =>
                        [
                            'message' => "Article could not be found"
                        ],
                    'data' =>
                        [

                        ],
                ],404
            );
        }

        if ($user->can('view', $article))
        {
            $article->title = $request->title;
            $article->link = $request->link;
            $article->notes = $request->notes;
            $article->save();

            return response()->json(
                [
                    'status' =>
                        [
                            "message" => "Article updated",
                            "code" => 200
                        ],
                    'errors' =>
                        [
                        ],
                    'data' =>
                        [
                            "article" => $article,
                        ],
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status' =>
                        [
                            "message" => "User not authorised for resource",
                            "code" => 403
                        ],
                    'errors' =>
                        [
                        ],
                    'data' => [],
                ],403
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @api {delete} /articles/destroy Delete an Article
     * @apiName DeleteArticle
     * @apiGroup Articles
     *
     * @apiSuccessExample {json} Server-Response:
     *  {
            "status": 200,
            "message": "Article deleted"
        }
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
                ],401
            );
        }

        $article = Article::find(Input::get('article_id'));

        if(!$article)
        {
            return response()->json(
                [
                    'status' =>
                        [
                            "message" => "Resource not found",
                            "code" => 404
                        ],
                    'errors' =>
                        [
                            'message' => "Article could not be found"
                        ],
                    'data' =>
                        [

                        ],
                ],404
            );
        }

        if ($user->can('view', $article))
        {
            $user->articles()->detach($article->id);
            return response()->json(
                [
                    "status" => 200,
                    "message" => "Article deleted",
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status' =>
                        [
                            "message" => "User not authorised for resource",
                            "code" => 403
                        ],
                    'errors' =>
                        [
                        ],
                    'data' =>
                        [

                        ],
                ],403
            );
        }
    }

    /**
     * Gets all of the user's articles.
     *
     * @api {get} /articles/all Get User's Articles
     * @apiName GetUserArticles
     * @apiGroup Articles
     *
     * @apiDescription
     * Get the user's saved articles
     *
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status HTTP response code
     * @apiSuccess {String} message Server message
     * @apiSuccess {Article[]} articles User's articles
     *
     * @apiSuccessExample {json} Server-Response:
     *  {
            "status": {
                "message": "Success",
                "code": 200
            },
            "errors": [],
            "data": {
                "articles": [
                    {
                        "id": 2,
                        "title": "Facebook",
                        "link": "facebook.com",
                        "notes": "These are notes",
                        "created_at": "2016-10-21 10:17:35",
                        "updated_at": "2016-10-21 10:17:35",
                        "pivot": {
                            "user_id": 3,
                            "article_id": 2
                        }
                    },
                    {
                        "id": 5,
                        "title": "Article",
                        "link": "http://google.com",
                        "notes": "These are updated notes",
                        "created_at": "2016-10-21 10:23:22",
                        "updated_at": "2016-10-21 10:28:46",
                        "pivot": {
                            "user_id": 3,
                            "article_id": 5
                        }
                    }
                ]
            }
        }
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
                    "status" =>
                        [
                            "message" => "error",
                            "code" => 401
                        ],
                    "errors" =>
                        [
                            "message" => "User could not be authenticated"
                        ],
                    "data" => []
                ],401
            );
        }
        return response()->json(

            [
                "status" =>
                    [
                        "message" => "Success",
                        "code" => 200
                    ],
                "errors" =>
                    [
                    ],
                "data" => [
                    "articles" => $user->articles
                ]
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
                ],401
            );
        }

        $article = Article::find(Input::get('article_id'));

        if(!$article)
        {
            return response()->json(
                [
                    'status' =>
                        [
                            "message" => "Resource not found",
                            "code" => 404
                        ],
                    'errors' =>
                        [
                            'message' => "Article could not be found"
                        ],
                    'data' =>
                        [

                        ],
                ],404
            );
        }

        if ($user->can('view', $article))
        {
            $recipient = User::where('email', $request->email)->get()->first();

            if(!$recipient)
            {
                return response()->json(
                    [
                        "Status" => 500,
                        "Message" => "The recipient is not registered with Ticket to Talk",
                    ],500
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
        else
        {
            return response()->json(
                [
                    'status' =>
                        [
                            "message" => "User not authorised for resource",
                            "code" => 403
                        ],
                    'errors' =>
                        [
                        ],
                    'data' =>
                        [

                        ],
                ],403
            );
        }

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
     * @apiSuccessExample {json} Server-Response:
     *  {
            "Status": 200,
            "Articles": [
                {
                    "id": 1,
                    "title": "Facebook",
                    "link": "http://facebook.com",
                    "notes": "Add some notes about the article!",
                    "created_at": "2016-10-21 09:55:36",
                    "updated_at": "2016-10-21 10:37:50",
                    "pivot": {
                        "user_id": 3,
                        "article_id": 1
                    }
                },
                {
                    "id": 2,
                    "title": "Facebook",
                    "link": "facebook.com",
                    "notes": "These are notes",
                    "created_at": "2016-10-21 10:17:35",
                    "updated_at": "2016-10-21 10:17:35",
                    "pivot": {
                        "user_id": 3,
                        "article_id": 2
                    }
                },
            ]
        }
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
                ],401
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
     * @apiSuccessExample {json} Server-Response:
     *  {
            "Status": 200,
            "Message": "Article accepted",
            "Articles": [
                {
                    "id": 1,
                    "title": "Facebook",
                    "link": "http://facebook.com",
                    "notes": "Add some notes about the article!",
                    "created_at": "2016-10-21 09:55:36",
                    "updated_at": "2016-10-21 10:37:50",
                    "pivot": {
                        "user_id": 3,
                        "article_id": 1
                    }
                },
                {
                    "id": 2,
                    "title": "Facebook",
                    "link": "facebook.com",
                    "notes": "These are notes",
                    "created_at": "2016-10-21 10:17:35",
                    "updated_at": "2016-10-21 10:17:35",
                    "pivot": {
                        "user_id": 3,
                        "article_id": 2
                    }
                },
                {
                    "id": 5,
                    "title": "Article",
                    "link": "http://google.com",
                    "notes": "These are updated notes",
                    "created_at": "2016-10-21 10:23:22",
                    "updated_at": "2016-10-21 10:28:46",
                    "pivot": {
                        "user_id": 3,
                        "article_id": 5
                    }
                }
            ]
        }
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
                ],401
            );
        }

        $sharedArticle = $user->sharedArticles->find($request->article_id);
        if (!$sharedArticle)
        {
            return response()->json(
                [
                    'status' =>
                        [
                            "message" => "Resource not found",
                            "code" => 404
                        ],
                    'errors' =>
                        [
                            'message' => "Article could not be found"
                        ],
                    'data' =>
                        [

                        ],
                ],404
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
     * @apiSuccessExample {json} Server-Response:
     *  {
            "Status": 200,
            "Message": "Article rejected"
        }
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
                ],401
            );
        }

        $sharedArticle = $user->sharedArticles->find($request->article_id);
        if (!$sharedArticle)
        {
            return response()->json(
                [
                    'status' =>
                        [
                            "message" => "Resource not found",
                            "code" => 404
                        ],
                    'errors' =>
                        [
                            'message' => "Article could not be found"
                        ],
                    'data' =>
                        [

                        ],
                ],404
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
