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

//  前半：条件＝こうしたら。。。
// 　　　　⇒送信形式：見たい（GET）or 伝えたい（POST）
// 　　　　⇒URL：住所
// 　　　　⇒Route:get('/',

//  後半：実行内容＝こうなる！
// 　　　　⇒ファイル名@アクション（関数）：どのファイルのどんな結果？
// 　　　　　例）合えるのか、付き合えるのか、フラれるのか？
// 　　　　⇒'UsersController@index');
Route::get('/','UsersController@index');
