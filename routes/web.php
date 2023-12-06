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
// ユーザー新規登録

use Illuminate\Routing\RouteGroup;

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');


// ログイン機能
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// トップページ表示
Route::get('/', 'UsersController@index');
// ユーザー詳細ページ
Route::group(['prefix' => 'users/{id}'], function () {
  Route::get('', 'UsersController@show')->name('user.show');
  Route::get('favorite', 'UsersController@favorites')->name('user.favorites');
});

Route::prefix('users')->group(function () {
  Route::get('{id}', 'UsersController@show')->name('user.show');
});


// ログイン後
Route::group(['middleware' => 'auth'], function () {
  // 動画
  Route::prefix('movies')->group(function () {
    Route::get('create', 'MoviesController@create')->name('movie.create');
    Route::post('', 'MoviesController@store')->name('movie.store');
    Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');
    Route::get('{id}/edit', 'MoviesController@edit')->name('movie.edit');
    Route::put('{id}', 'MoviesController@update')->name('movie.update');
  });

  // いいね
  Route::group(['prefix' => 'movies/{id}'], function () {
    Route::post('favorite', 'FavoriteController@store')->name('favorite');
    Route::delete('unfavorite', 'FavoriteController@destroy')->name('unfavorite');
  });
});
