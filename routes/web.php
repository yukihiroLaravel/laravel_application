<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'UsersController@index');

// ユーザ新規登録
Route::get('singup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('singup', 'Auth\RegisterController@register')->name('signup.post');
