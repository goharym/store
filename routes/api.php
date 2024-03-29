<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1', 'middleware' => 'lang'], function () {

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
        'category' => 'Category\CategoryController',
        'store' => 'Store\StoreController',
        'product' => 'Product\ProductController',
        'cart-item' => 'Cart\CartController'
    ]);

});
