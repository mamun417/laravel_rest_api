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

//start auth
Route::post('register', 'ApiAuth\RegisterController@register');
Route::group(['prefix' => 'auth', 'namespace' => 'ApiAuth'], function () {
    Route::post('login', 'AuthController@login');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'auth', 'namespace' => 'ApiAuth'], function () {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::post('password/email', 'ApiAuth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'ApiAuth\ResetPasswordController@reset');
//end auth

Route::group(['middleware' => 'auth:api'], function ()
{
    //product
    Route::apiResource('products', 'ProductController');

    //user
    Route::patch('profile-update', 'UserController@updateProfile');
    Route::post('check-password', 'UserController@checkPassword');
    Route::patch('change-password', 'UserController@changePassword');
});
