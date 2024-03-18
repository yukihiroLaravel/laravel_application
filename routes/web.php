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
    // return view('welcome');
// });

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('/','UsersController@index');
// getリクエスト（第1引数'/（というURL）'に対し、見たい・アクセスしたい。とのリクエスト）が出た際に、第2引数にある指示を実行させる。という意味。
// ここでの第2引数：UsersControllerの中の（＠の後ろ）indexメソッド　に処理を送る。というもの。
