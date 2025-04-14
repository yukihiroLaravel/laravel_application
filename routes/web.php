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

// 前半：Route::get or post('/',
// 　　　条件＝こうしたら…
// 　　　送信形式：get(見たい) or post(伝えたい)
//       URL：住所
// 後半：function ()
// 　　　実行内容＝こうなる！
// 　　　ファイル名＠アクション（関数）：どのファイルのどんな結果？

Route::get('/', 'UsersController@index');
