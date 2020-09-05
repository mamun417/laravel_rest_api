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

// start auth
Route::post('register', 'ApiAuth\RegisterController@register');
Route::post('password/email', 'ApiAuth\ForgotPasswordController@sendResetLinkEmail');
Route::put('password/reset', 'ApiAuth\ResetPasswordController@reset');

Route::group(['prefix' => 'auth', 'namespace' => 'ApiAuth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('refresh', 'AuthController@refresh');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'auth', 'namespace' => 'ApiAuth'], function () {
    Route::post('logout', 'AuthController@logout');
    Route::post('me', 'AuthController@me');
});
// end auth

Route::group(['middleware' => 'auth:api'], function ()
{
    // product
    Route::patch('products/change-status/{product}', 'ProductController@changeStatus');
    Route::get('products/count-info', 'ProductController@countInfo');
    Route::delete('products/delete', 'ProductController@destroy');
    Route::apiResource('products', 'ProductController');

    // skill
    Route::get('skill-list', 'SkillController@getSkillList');
    Route::apiResource('skills', 'SkillController');

    // user
    Route::patch('profile/update', 'UserController@updateProfile');
    Route::post('password/check', 'UserController@checkPassword');
    Route::patch('password/change', 'UserController@changePassword');
    Route::post('change/image', 'UserController@changeImage');

    Route::get('pdf', function () {
        $pdf = PDF::loadView('pdf.pdf');
        return $pdf->stream();
    });
});

