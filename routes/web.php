<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $data = [
        [
            'name' => 'A new comment.',
        ],
        [
            'name' => 'Another new comment.',
        ],
    ];

    \App\Skill::createMany($data);


    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
