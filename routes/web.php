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

// 【ログイン】
// ログイン画面の表示
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// ログイン情報の送信
Route::post('login', 'Auth\LoginController@login')->name('login.post');
// ログイン状態からログアウト
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//トップページ表示
Route::get('/', 'UsersController@index');
