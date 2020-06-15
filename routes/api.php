<?php

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

//start auth routes
Route::post('register', 'UserController@register');
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function () {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
//end auth routes

Route::group(['middleware' => 'auth:api'], function () {

    //product routes
    Route::apiResource('products', 'ProductController');

    //user routes
    Route::patch('profile-update', 'UserController@updateProfile');
});
