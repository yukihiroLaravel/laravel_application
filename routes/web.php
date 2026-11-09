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

// ログイン後　['middleware' => 'auth']でログインしているか？していないか？の判定をする
Route::group(['middleware' => 'auth'], function () { //この行でログイン後にcreate、store、deleteにアクセスできる。
    // 動画
    Route::prefix('movies')->group(function () { 
        Route::get('create', 'MoviesController@create')->name('movie.create'); // create 新規登録画面の表示
        Route::post('', 'MoviesController@store')->name('movie.store');// store 動画の登録機能
        Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');//delete 動画の削除機能
    });
});
