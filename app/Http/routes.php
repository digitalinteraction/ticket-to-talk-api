<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function() {
    return view('home');
});

Route::get("/docs", function() {
    return File::get(public_path() . "/docs/index.html");
});

// API - AUTHENTICATION
Route::group(
    [
        'prefix' => 'api',
        'namespace' => 'Api',
        'middleware' =>
            [
                'limit:10,10',
                'log'
            ],
        "https" => true
    ], function () {
        Route::post('/auth/register',
            [
                'as' => 'auth.register',
                'uses' => 'AuthController@register'
            ]
        );

        Route::post('/auth/login',
            [
                'as' => 'auth.login',
                'uses' => 'AuthController@login'
            ]
        );
    }
);

// API - ARTICLES
Route::group(
    [
        'prefix' => 'api/articles',
        'namespace' => 'Api',
        'middleware' =>
            [
                'api',
                'log'
            ],
        "https" => true
    ],
    function()
    {
        Route::post('store/',
            [
                'as' => 'article.store',
                'uses' => 'ArticleController@store'
            ]
        );

        Route::get('show/',
            [
                'as' => 'article.show',
                'uses' => 'ArticleController@show'
            ]
        );

        Route::get('all/',
            [
                'as' => 'article.getUserArticles',
                'uses' => 'ArticleController@getUserArticles'
            ]
        );

        Route::post('update/',
            [
                'as' => 'article.update',
                'uses' => 'ArticleController@update'
            ]
        );

        Route::delete('destroy/',
            [
                'as' => 'article.destroy',
                'uses' => 'ArticleController@destroy'
            ]
        );

        Route::post('share/send',
            [
                'as' => 'article.share.send',
                'uses' => 'ArticleController@shareArticle'
            ]
        );

        Route::get('share/get',
            [
                'as' => 'article.share.get',
                'uses' => 'ArticleController@getSharedArticles'
            ]
        );

        Route::post('share/accept',
            [
                'as' => 'article.share.accept',
                'uses' => 'ArticleController@acceptArticle'
            ]
        );

        Route::post('share/reject',
            [
                'as' => 'article.share.reject',
                'uses' => 'ArticleController@rejectArticle'
            ]
        );
    }
);

// API - TAGS
Route::group(
    [
        'prefix' => 'api/tags',
        'namespace' => 'Api',
        'middleware' =>
            [
                'api',
                'log'
            ],
        "https" => true
    ],
    function()
    {
        Route::post('store/',
            [
                'as' => 'tag.store',
                'uses' => 'TagController@store'
            ]
        );

        Route::get('show/',
            [
                'as' => 'tag.show',
                'uses' => 'TagController@show'
            ]
        );

        Route::get('all/',
            [
                'as' => 'tag.getUserTags',
                'uses' => 'TagController@getUserTags'
            ]
        );

        Route::post('update/',
            [
                'as' => 'tag.update',
                'uses' => 'TagController@update'
            ]
        );

        Route::delete('destroy/',
            [
                'as' => 'tag.destroy',
                'uses' => 'TagController@destroy'
            ]
        );

    }
);

// API - TICKETS
Route::group(
    [
        'prefix' => 'api/tickets',
        'namespace' => 'Api',
        'middleware' =>
            [
                'api',
                'log'
            ],
        "https" => true
    ],
    function()
    {
        Route::post('store/',
            [
                'as' => 'ticket.store',
                'uses' => 'TicketController@store'
            ]
        );

        Route::get('show/',
            [
                'as' => 'ticket.show',
                'uses' => 'TicketController@show'
            ]
        );

        Route::get('all/',
            [
                'as' => 'ticket.getUserTickets',
                'uses' => 'TicketController@getUserTickets'
            ]
        );

        Route::post('update/',
            [
                'as' => 'ticket.update',
                'uses' => 'TicketController@update'
            ]
        );

        Route::delete('destroy/',
            [
                'as' => 'ticket.destroy',
                'uses' => 'TicketController@destroy'
            ]
        );

        Route::get('download',
            [
                'as' => 'ticket.download',
                'uses' => 'TicketController@downloadTicket'
            ]
        );
    }
);

// API - PEOPLE
Route::group(
    [
        'prefix' => 'api/people',
        'namespace' => 'Api',
        'middleware' =>
            [
                'api',
                'log'
            ],
        "https" => true
    ],
    function()
    {
        Route::post('store/',
            [
                'as' => 'person.store',
                'uses' => 'PersonController@store'
            ]
        );

        Route::get('show/',
            [
                'as' => 'person.show',
                'uses' => 'PersonController@show'
            ]
        );

        Route::get('all/',
            [
                'as' => 'person.getUserPeople',
                'uses' => 'PersonController@getUserPeople'
            ]
        );

        Route::post('update/',
            [
                'as' => 'people.update',
                'uses' => 'PersonController@update'
            ]
        );

        Route::delete('destroy/',
            [
                'as' => 'people.destroy',
                'uses' => 'PersonController@destroy'
            ]
        );

        Route::get('getusers/',
            [
                'as' => 'people.get_users',
                'uses' => 'PersonController@getUsers'
            ]
        );

        Route::get('tickets/',
            [
                'as' => 'people.tickets',
                'uses' => 'PersonController@getTickets'
            ]
        );

        Route::get('picture',
            [
                'as' => 'people.picture',
                'uses' => 'PersonController@getProfilePicture'
            ]
        );
    }
);

// API - USER
Route::group(
    [
        'prefix' => 'api/user',
        'namespace' => 'Api',
        'middleware' =>
            [
                'api',
                'log'
            ],
        "https" => true
    ],
    function()
    {
        Route::get('show/',
            [
                'as' => 'user.show',
                'uses' => 'PersonController@show'
            ]
        );

        Route::post('update/',
            [
                'as' => 'user.update',
                'uses' => 'UserController@update'
            ]
        );

        Route::delete('destroy/',
            [
                'as' => 'user.destroy',
                'uses' => 'PersonController@destroy'
            ]
        );

        Route::get('getpeople/',
            [
                'as' => 'user.getpeople',
                'uses' => 'UserController@getAssociatedPeople'
            ]
        );

        Route::get('invitations/get',
            [
                'as' => 'user.invitations.get',
                'uses' => 'UserController@getInvitations'
            ]
        );

        Route::post('invitations/send',
            [
                'as' => 'user.invitations.send',
                'uses' => 'UserController@sendInvitation'
            ]
        );

        Route::post('invitations/accept',
            [
                'as' => 'user.invitations.accept',
                'uses' => 'UserController@acceptInvitation'
            ]
        );

        Route::post('invitations/reject',
            [
                'as' => 'user.invitations.reject',
                'uses' => 'UserController@rejectInvitation'
            ]
        );

        Route::get('picture',
            [
                'as' => 'user.picture',
                'uses' => 'UserController@getProfilePicture'
            ]
        );
    }
);

// API - INSPIRATION
Route::group(
    [
        'prefix' => 'api/inspiration',
        'namespace' => 'Api',
        'middleware' =>
            [
                'api',
                'log'
            ],
        "https" => true
    ],
    function () {
        Route::get('/get',
            [
                'as' => 'inspiration.get',
                'uses' => 'InspirationController@index'
            ]
        );
    }
);

// API - MEDIA
//Route::group(
//    [
//        'prefix' => 'api/media',
//        'namespace' => 'Api',
//        'middleware' =>
//            [
//                'api',
//                'log'
//            ],
//        "https" => true
//    ],
//    function () {
//        Route::get('/get',
//            [
//                'as' => 'media.get',
//                'uses' => 'MediaController@getMedia'
//            ]
//        );
//    }
//);

// API - CONVERSATIONS
Route::group(
    [
        'prefix' => 'api/conversations',
        'namespace' => 'Api',
        'middleware' =>
            [
                'api',
                'log'
            ],
        "https" => true
    ],
    function () {
        Route::get('/get',
            [
                'as' => 'conversation.get',
                'uses' => 'ConversationController@index'
            ]
        );

        Route::post('/store',
            [
                'as' => 'conversation.store',
                'uses' => 'ConversationController@store'
            ]
        );

        Route::post('/update',
            [
                'as' => 'conversation.update',
                'uses' => 'ConversationController@update'
            ]
        );

        Route::post('/tickets/add',
            [
                'as' => 'conversation.tickets.add',
                'uses' => 'ConversationController@addTicket'
            ]
        );

        Route::post('/tickets/remove',
            [
                'as' => 'conversation.tickets.remove',
                'uses' => 'ConversationController@removeTicket'
            ]
        );

        Route::get('/destroy',
            [
                'as' => 'conversation.destroy',
                'uses' => 'ConversationController@destroy'
            ]
        );
    }
);