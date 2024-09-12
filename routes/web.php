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
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup'); //新規登録画面表示
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post'); //新規登録実行

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); // ログイン画面の表示
Route::post('login', 'Auth\LoginController@login')->name('login.post'); //ログイン実行
Route::get('logout', 'Auth\LoginController@logout')->name('logout'); //ログアウト実行

// ユーザー
Route::get('/', 'UsersController@index')->name('users'); //トップページの表示(動画一覧）)
Route::group(['prefix' => 'users/{id}'], function(){
    Route::get('', 'UsersController@show')->name('user.show'); // ユーザー詳細ページの表示
    Route::get('favorites', 'UsersController@favorites')->name('user.favorites'); //お気に入り一覧の表示
});

// ログイン後
Route::group(['middleware' => 'auth'],function(){
    //動画
    Route::prefix('movies')->group(function(){
        // 動画登録ページの表示
        Route::get('create', 'MoviesController@create')->name('movie.create');
        // 動画登録を実行
        Route::post('', 'MoviesController@store')->name('movie.store');
        // 動画削除を実行
        Route::delete('{id}','MoviesController@destroy')->name('movie.delete');
        // 動画編集ページの表示
        Route::get('{id}/edit', 'MoviesController@edit')->name('movie.edit');
        // 動画情報の更新を実行
        Route::put('{id}', 'MoviesController@update')->name('movie.update');
    });
    // いいね
    Route::group(['prefix' => 'movies/{id}'], function(){
        // お気に入り登録を実行
        Route::post('favorite', 'FavoriteController@store')->name('favorite');
        // お気に入り削除を実行
        Route::delete('unfavorite', 'FavoriteController@destroy')->name('unfavorite');
    });
});
