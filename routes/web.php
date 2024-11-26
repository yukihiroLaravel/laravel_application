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

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
// 新規登録用のフォームを表示するためのルート

Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// 新規登録のフォームで送信されたデータを受け取り、処理するためのルート

Route::get('/', 'UsersController@index');
// トップページを表示させるためのルート
