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

//API
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

        Route::post('/auth/test',
            [
                'as' => 'auth.test',
                'uses' => 'UserController@testPost'
            ]
        );

//        Route::get('/', 'UserController@testHome');
    }
);

//Route::get('/', function () {
//    return view('welcome');
//});
//
//
//Route::get('/test', 'UserController@testHome');
//
//// Areas
//Route::get('/areas', 'AreaController@index');
//Route::get('/areas/{id}', 'AreaController@show');