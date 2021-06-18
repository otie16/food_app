<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorItemController;

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

  Route::get('test', 'OrderController@index');
  
    Route::group(['prefix' => 'auth'], function() {

      Route::post('login', 'AuthController@login');
      Route::post('register', 'AuthController@register');
      Route::post('logout', 'AuthController@logout');
      Route::post('refresh', 'AuthController@refresh');
      Route::get('me', 'AuthController@me');
      Route::get('test', 'AuthController@test');

    });

          
    // Route::group(['prefix' => 'user', 'namespace' => 'User'], function() {
      
    //   Route::get('items', 'VendorItemController@index');
    //   Route::post('items', 'VendorItemController@store');
    
    // });

    });