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

//ユーザ登録
Route::get('signup','Auth\RegisterController@showRegistrationForm') ->name('signup');
Route::post('signup','Auth\RegisterController@register') ->name('signup.post');

// ログイン後
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'UsersController@index');
Route::group(['prefix'=>'users/{id}'],function(){
    Route::get('','UsersController@show')->name('user.show');
    Route::get('favorites','UsersController@favorites')->name('user.favorites');
});

//ログイン後にしか見れないという条件を記述している。midleware =>authでログイン後にしか見れないという条件を追加したことになる
Route::group(['middleware' => 'auth'],function(){

    //動画　prefixはRouteの最初に書くmoviesというアドレスを省略できるという意味
    Route::prefix('movies')->group(function()
    {
        //＠createで新規登録画面を表示し、@storeで新規登録を実行するのでこの２つはセットで使う
        Route::get('create','MoviesController@create')->name('movie.create');
        Route::post('','MoviesController@store')->name('movie.store');
        Route::delete('{id}','MoviesController@destroy')->name('movie.delete');
        Route::get('{id}/edit','MoviesController@edit')->name('movie.edit');
        Route::put('{id}','MoviesController@update')->name('movie.update');
    });

    //いいね機能
    Route::group(['prefix'=>'movie/{id}'],function(){
        Route::post('favorite','FavoriteController@store')->name('favorite');
        Route::delete('unfavorite','FavoriteController@destroy')->name('unfavorite');
    });
});