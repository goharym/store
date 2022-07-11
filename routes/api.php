<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {

    /*
    |--------------------------------------------------------------------------
    | Auth Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'auth'], function () {

        //Login
        Route::post('login', 'Auth\LoginController@login');

    });

    /*
    |--------------------------------------------------------------------------
    | Resource Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::apiResources([
        'user' => 'User\UserController',
    ]);

});
