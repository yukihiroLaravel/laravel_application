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

// 【ユーザ新規登録】
// ユーザー新規登録画面
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
// ユーザー新規登録情報の送信
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//トップページ表示
Route::get('/', 'UsersController@index');
