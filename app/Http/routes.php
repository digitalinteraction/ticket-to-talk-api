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

// TODO: DELETE
// API - TESTING
Route::group(
    [
        'prefix' => 'api',
        'namespace' => 'Api'
    ], function () {
        Route::get('/test/getTag',
            [
                'as' => 'test.getTag',
                'uses' => 'TestController@getTag',
                'https' => true
            ]
        );

        Route::get('/test/write',
            [
                'as' => 'test.write',
                'uses' => 'TestController@writeTextToFile',
            ]
        );

        Route::post('/test/receiveImage',
            [
                'as' => 'test.receiveImage',
                'uses' => 'TestController@receiveImage',
                'https' => true
            ]
        );

        Route::get('/test/getImage',
            [
                'as' => 'test.getImage',
                'uses' => 'TestController@getImage',
                'https' => true
            ]
        );

        Route::get('/test/getImageBytes',
            [
                'as' => 'test.getImageBytes',
                'uses' => 'TestController@getImageBytes',

            ]
        );

        Route::post('/test/receiveAudio',
            [
                'as' => 'test.receiveAudio',
                'uses' => 'TestController@receiveAudio'
            ]
        );
    }
);

// API - AUTHENTICATION
Route::group(
    [
        'prefix' => 'api',
        'namespace' => 'Api'
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

        Route::get('/auth/test/',
            [
                'as' => 'auth.test',
                'uses' => 'AuthController@getUser'
            ]
        );
    }
);

// API - ARTICLES
Route::group(
    [
        'prefix' => 'api/articles',
        'namespace' => 'Api'
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
    }
);

// API - TAGS
Route::group(
    [
        'prefix' => 'api/tags',
        'namespace' => 'Api'
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
        'namespace' => 'Api'
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
    }
);

// API - PEOPLE
Route::group(
    [
        'prefix' => 'api/people',
        'namespace' => 'Api'
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
    }
);

// API - USER
Route::group(
    [
        'prefix' => 'api/user',
        'namespace' => 'Api'
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
                'uses' => 'PersonController@update'
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
    }
);

// API - INSPIRATION
Route::group(
    [
        'prefix' => 'api/inspiration',
        'namespace' => 'Api'
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
Route::group(
    [
        'prefix' => 'api/media',
        'namespace' => 'Api'
    ],
    function () {
        Route::get('/get',
            [
                'as' => 'media.get',
                'uses' => 'MediaController@getMedia'
            ]
        );
    }
);