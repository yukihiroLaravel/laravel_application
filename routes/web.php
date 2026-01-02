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

// Route::get('/', function () {
//     return view('welcome');
// });

// 3-2_ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 3-3_ログイン・ログアウト
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// 3-1_トップページを表示させる
Route::get('/', 'UsersController@index');

// 4-4_ユーザ詳細（今後も増えていくので'prefix'(接頭辞)でグループ化してる）
Route::prefix('users')->group(function () {
    Route::get('{id}', 'UsersController@show')->name('user.show');
            // 'users.{id}'が、グループ化されてるので、'{id}'となっている
});

// Route::get ー GET（取得）メソッドが実行されたときに、
// 第２引数のコントローラのメソッドへ処理を送る
// つまり、ブラウザ上でトップページ’/’へのアクセスすると、
// Usersコントローラのindexメソッドを実行するという意味です！

// 4-3_動画登録・ユーザー一覧
// ログイン後
Route::group(['middleware' => 'auth'], function () {
    // 「middleware」は備え付けの機能で、コントローラーに入る直前の処理
    // （'auth'にログインしてるかどうかの判定。ログインしていたら、以下行える）
    // 動画　（「prefix」はルーティングのアドレス（movies/）を省略できる機能）
    Route::prefix('movies')->group(function () {
        // 動画の新規登録画面表示（create）
        Route::get('create', 'MoviesController@create')->name('movie.create');
        // 動画の登録機能（store）
        Route::post('', 'MoviesController@store')->name('movie.store');
        // 動画の削除機能（destroy）
        Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');
    });
});



