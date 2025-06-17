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

// ユーザ
Route::get('/', 'UsersController@index');
Route::group(['prefix' => 'users/{id}'],function(){
    Route::get('', 'UsersController@show')->name('user.show');
    // ユーザがいいねしている動画一覧を表示する
    // ここでは、UsersControllerのfavoritesメソッドが呼び出される
    Route::get('favorites','UsersController@favorites')->name('user.favorites');
});


// ログイン後
// Route::groupとは、特定のミドルウェアを適用するためのグループ化を行う
// ここでは、authミドルウェアを適用しているため、ログイン済みのユーザのみにget,post,deleteを表示する
Route::group(['middleware' => 'auth'], function () {
    // 動画
    // Route::prefixは、URLのプレフィックスを指定するためのメソッド
    // ここでは、moviesというプレフィックスを指定しているため、URLは/movies/create, /movies, /movies/{id}となる
    Route::prefix('movies')->group(function () {
        Route::get('create', 'MoviesController@create')->name('movie.create');
        Route::post('', 'MoviesController@store')->name('movie.store');
        Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');
    });

    // いいね
    // prefixは、URLのプレフィックスを指定するためのメソッド
    // ここでは、movies/{id}というプレフィックスを指定しているため、URLは/movies/{id}/favorite, /movies/{id}/unfavoriteとなる
    Route::group(['prefix' => 'movies/{id}'],function(){
        // いいね！をする
        // favoriteのURLにアクセスすると、FavoriteControllerのstoreメソッドが呼び出される
        Route::post('favorite','FavoriteController@store')->name('favorite');
        // いいね！を解除する
        // unfavoriteのURLにアクセスすると、FavoriteControllerのdestroyメソッドが呼び出される
        Route::delete('unfavorite','FavoriteController@destroy')->name('unfavorite');
    });

});