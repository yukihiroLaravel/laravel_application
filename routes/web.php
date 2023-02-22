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
// ブラウザ上の/にアクセスした場合にUsersControllerの＠indexメソッドを呼び出すという意味（トップページ）
// ゲットリクエスト、ポストリクエストもある
Route::get('/','UsersController@index');