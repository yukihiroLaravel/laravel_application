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
// 新規登録用のフォームを表示するためのルート

Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// 新規登録のフォームで送信されたデータを受け取り、処理するためのルート
//POSTリクエストは、サーバーにデータを送信する際に使用するもの

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// ログイン画面を表示するためのルート

Route::post('login', 'Auth\LoginController@login')->name('login.post');
// ログイン処理を実行するためのルート
// POSTリクエストを受け取り、ユーザーが送信した認証情報（メールアドレスやパスワードなど）を処理して、ログインを試みる

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//ログアウト処理をGETリクエストで行うためのルート定義
//しかし、セキュリティ上の観点から推奨されない方法。
//Laravelの標準的なログアウト処理は通常 POSTリクエストを使用して実装される

Route::get('/', 'UsersController@index');
// トップページを表示させるためのルート


// ログイン後
Route::group(['middleware' => 'auth'], function () {
  //ログイン後にしか3つのルートにアクセスできない
  //'middleware'= 各コントローラーに行く前に必ず通る処理
  // 'auth'と指定することで、ログインしているかしていないかを判断
  //ログインしていたら表示する、未ログインだったら表示しない、条件分岐のように表示の切り分けができる


  // 動画
  Route::prefix('movies')->group(function () {
    //prefix= ルーティングのアドレスを省略できる


    Route::get('create', 'MoviesController@create')->name('movie.create');
    // 動画の新規登録画面の表示のルート


    Route::post('', 'MoviesController@store')->name('movie.store');
    // 動画の登録機能のルート


    Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');
    // 動画の削除機能
  });
});
