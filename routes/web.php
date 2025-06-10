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
// Route::get(‘アドレス(○○/{パラメータ})’, ‘コントローラ名@アクション名’);
// ユーザ新規登録 画面表示
// signupのURLにアクセスすると、Authのディレクトリ下にあるRegisterControllerのshowRegistrationFormメソッドが呼び出される
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
// ユーザ新規登録 実行
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン
// loginのURLにアクセスすると、Authのディレクトリ下にあるLoginControllerのshowLoginFormメソッドが呼び出される
// ログイン画面表示
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// ログイン実行
Route::post('login', 'Auth\LoginController@login')->name('login.post');
// ログアウト
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'UsersController@index');