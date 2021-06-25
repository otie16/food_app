<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['middleware' => 'api'], function ($router) {
    // Route::post('item', 'VendorItemController@store');
    Route::get('test', 'OrderController@index');
    // Route::get('item', 'VendorItemController@index');

    Route::group(['prefix' => 'auth'], function () {

        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');
        Route::get('test', 'AuthController@test');

    });

    Route::group(['middleware' => 'jwt.auth'], function () {
        
            Route::group(['prefix' => 'user', 'namespace' => 'User'], function ($id) {

                Route::get('item', 'VendorItemController@index');
                Route::post('item', 'VendorItemController@store');
                Route::get('items/{id}', 'VendorItemController@show');
            });

            Route::group(['prefix' => 'vendor', 'namespace' => 'Restaurant'], function () {

                Route::post('shop', 'RestaurantController@store');
                Route::get('shop', 'RestaurantController@index');
            });
        });
   
});
