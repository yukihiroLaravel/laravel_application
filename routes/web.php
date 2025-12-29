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

Route::get('/', 'UsersController@index');

// Route::get ー GET（取得）メソッドが実行されたときに、
// 第２引数のコントローラのメソッドへ処理を送る
// つまり、ブラウザ上でトップページ’/’へのアクセスすると、
// Usersコントローラのindexメソッドを実行するという意味です！

