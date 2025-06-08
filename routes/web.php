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
// ユーザの新規登録画面の表示と登録処理のルーティングを定義
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン
// ログイン画面の表示とログイン処理のルーティングを定義
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ユーザ
Route::get('/', 'UsersController@index')->name('users');
// prefixメソッドはグループ内の各ルートに対して、指定されたURIのプレフィックスを指定するために使用
// ここでは、'users'というプレフィックスが付与されるため、
// 例えば、'users/1'のようなURLでアクセスできるようになる。
Route::group(['prefix' => 'users/{id}'],function(){
    // ユーザの詳細画面の表示
    Route::get('', 'UsersController@show')->name('user.show');
    // ユーザがいいねした動画の一覧表示
    Route::get('favorites','UsersController@favorites')->name('user.favorites');});

// ログイン後
// Route::group ー ルーティングのグループを作成。
// ログインユーザのみ、ここに記述しているルーティングにアクセスできるように制限。
Route::group(['middleware' => 'auth'], function () {
    // 動画
    // 動画の新規登録、削除、編集、更新のルーティングを定義
    Route::prefix('movies')->group(function () {
        // 動画の一覧表示のルーティングを定義
        Route::get('create', 'MoviesController@create')->name('movie.create');
        // 動画の新規登録処理を実行
        Route::post('', 'MoviesController@store')->name('movie.store');
        // deleteメソッドは、指定されたIDの動画を削除するためのルーティングを定義
        Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');
        // 動画の編集画面の表示と更新処理のルーティングを定義
        Route::get('{id}/edit', 'MoviesController@edit')->name('movie.edit');
        // 動画の更新処理を実行
        Route::put('{id}', 'MoviesController@update')->name('movie.update');
    });
    });

    // いいね
    // 動画に対する「いいね」機能のルーティングを定義
    // ここでは、動画のIDをパラメータとして受け取り、いいねの登録と削除を行うルーティングを定義
    Route::group(['prefix' => 'movies/{id}'],function(){
        // URL movies/{id}/favoriteにPOSTリクエストを送ると、FavoriteControllerのstoreメソッドが呼び出される
        // いいねを押したとき、いいねした動画のIDを受け取りコントローラーに実行される。
        Route::post('favorite','FavoriteController@store')->name('favorite');
        // URL movies/{id}/unfavoriteにDELETEリクエストを送ると、FavoriteControllerのdestroyメソッドが呼び出される
        Route::delete('unfavorite','FavoriteController@destroy')->name('unfavorite');
    });