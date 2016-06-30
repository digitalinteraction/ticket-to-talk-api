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
                'uses' => 'TagController@getUserArticles'
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