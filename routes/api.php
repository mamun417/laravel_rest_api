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

    // socialite
    Route::get('login/{provider}', 'SocialAuthController@redirect');
    Route::get('login/{provider}/callback', 'SocialAuthController@callback');
    Route::post('login/social', 'SocialAuthController@login');

    Route::post('refresh', 'AuthController@refresh');

    // admin list
    Route::get('admin/list', 'AuthController@adminList');
    // change admin password before login to get correct credential for login
    Route::post('admins/change-password/before-login/{admin_id}', 'AuthController@changeAdminPasswordForBeforeLogin');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'auth', 'namespace' => 'ApiAuth'], function () {
    Route::post('logout', 'AuthController@logout');
    Route::post('me', 'AuthController@me');
});
// end auth


Route::group(['middleware' => 'auth:api'], function () {
    // administrator
    Route::group(['namespace' => 'Administrator'], function () {
        Route::apiResource('admins', 'AdminController');
        Route::get('roles/list', 'RoleManageController@list');
        Route::apiResource('roles', 'RoleManageController');
        Route::get('permission/modules', 'PermissionController@permissionModules');
    });

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

