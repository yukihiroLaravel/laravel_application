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
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');//ログインへアクセスした際、showLoginFormを実行。ユーザーがログインする。
Route::post('login', 'Auth\LoginController@login')->name('login.post');//ログインへpostリクエストを送信した際、loginメソッドを実行。ユーザーの認証。
Route::get('logout', 'Auth\LoginController@logout')->name('logout');//logoutへアクセスした際、logoutメソッドを実行。ユーザーがログアウトする。

//ユーザー
Route::get('/', 'UsersController@index');
Route::group(['prefix' => 'users/{id}'],function(){ //パスの先頭がuser/{id}になる。
    Route::get('','UsersController@show')->name('user.show');
    Route::get('favorites','UsersController@favorites')->name('user.favorites');//ログイン前でもお気に入り一覧を見れる。
});

//ログイン後
Route::group(['middleware' => 'auth' ], function(){ //ログインしているか確認し、ログインしている場合以下の内容を実行できる。

    Route::prefix('movies')->group(function(){ //moviesというURLのパスを共有するルートをグループ化している。このグループ内のルートはmoviesから始まる。
        Route::get('create', 'MoviesController@create')->name('movie.create'); //createにアクセスした際メソッドを実行。動画の新規登録画面表示。
        Route::post('', 'MoviesController@store')->name('movie.store'); //moviesへpostリクエストを送信した際storeメソッドを実行。DBに新しい動画のデータを保存する。
        Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');//IDへdeleteリクエストを送信した際destroyメソッドを実行。DBから指定されたIDの動画を削除する。
        Route::get('{id}/edit','MoviesController@edit')->name('movie.edit');
        Route::put('{id}','MoviesController@update')->name('movie.update');
    });
});

// いいね
Route::group(['prefix' => 'movies/{id}'],function(){
    Route::post('favorite','FavoriteController@store')->name('favorite');//いいねする。
    Route::delete('unfavorite','FavoriteController@destroy')->name('unfavorite');//いいねを削除する。
});