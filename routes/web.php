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

// ->name() ー ルーティングに対して命名を行うことで、ルーティングを呼び出しやすくなります。
// 今回であれば、signup や signup.post という名前でシンプルに各ルーティングを呼び出すことができます。

// HTTPリクエストの４メソッド（CRUD処理）
// GETメソッド (Read)
// POSTメソッド (Create)
// PUTメソッド (Update)
// DELETEメソッド (Delete)

// // 詳細ページ表示
// Route::get('movies/{id}', 'MoviesController@show');
// // 新規登録を実行
// Route::post('movies', 'MoviesController@store');
// // 更新を実行
// Route::put('movies/{id}', 'MoviesController@update');
// // 削除を実行
// Route::delete('movies/{id}', 'MoviesController@destroy');
// ルーティングの基本の記述

// Route::get(‘アドレス(○○/{パラメータ})’, ‘コントローラ名@アクション名’);
// コントローラに続くメソッド（アクション）は主に show, store, update, destroy を使うことが多いです。
// {パラメータ}はなぜ、付いていたり付いていなかったりするのでしょうか？考えてみましょう！
// たとえば、showアクションを実行する場合なら、下記のアドレスにアクセスされることになります。
// アドレス）https://gut-familie.com/movies/1
// storeアクションは、新規の動画情報を作る前にアクセスされるURLなので、{id}はアクセスの時点では存在しないからです！

// その他よく使う３つのルーティング
// ルーティングの例
// // 一覧ページ表示
// Route::get('movies', 'MoviesController@index');
// // 新規登録画面表示
// Route::get('movies/create', 'MoviesController@create');
// // 編集画面表示
// Route::get('messages/{id}/edit', 'MoviesController@edit');
// コントローラに続くメソッド（アクション）は主に index, create, edit を使うことが多いです。

// 3-1_トップページを表示させる
Route::get('/', 'UsersController@index');

// Route::get ー GET（取得）メソッドが実行されたときに、
// 第２引数のコントローラのメソッドへ処理を送る
// つまり、ブラウザ上でトップページ’/’へのアクセスすると、
// Usersコントローラのindexメソッドを実行するという意味です！

