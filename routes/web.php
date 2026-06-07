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

//トップページ表示(ユーザー一覧画面)
Route::get('/', 'UsersController@index');

// ログイン後
Route::group(['middleware' => 'auth'], function () {
    // 【動画登録】
    Route::prefix('movies')->group(function () {
        // 動画登録画面表示
        Route::get('create', 'MoviesController@create')->name('movie.create');
        // 動画登録情報の送信
        Route::post('', 'MoviesController@store')->name('movie.store');
        // 登録動画の削除
        Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');
    });
});
