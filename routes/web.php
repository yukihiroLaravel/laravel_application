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
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ユーザ
Route::get('/', 'UsersController@index');
Route::prefix('users')->group(function () {
    Route::get('{id}', 'UsersController@show')->name('user.show');
});

// ログイン後（しか表示されない）
// authはログインしているかを判定している。ミドルウェアを使うことで、ログインしているユーザだけがアクセスすることになる。
Route::group(['middleware' => 'auth'], function () {
    // 動画
    // prefixはURLの共通部分をまとめることができる。prefix('movies')は下のルーティングにおいて、URLの先頭に/moviesをつけている。
    Route::prefix('movies')->group(function () {
        // 動画新規登録
        Route::get('create', 'MoviesController@create')->name('movie.create');
        // 動画登録機能
        Route::post('', 'MoviesController@store')->name('movie.store');
        //　動画削除機能
        Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');
    });
});