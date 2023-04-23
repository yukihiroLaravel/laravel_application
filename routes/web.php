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

Route::get('/', "UsersController@index");

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');



//　練習
Route::get("hello/{msg?}",function($msg="no massage") {

    $html =<<< EOM
    <html>
    <head>
    <title>Hello</title>
    <style>
        body{font-size:16pt color:#999;}
        h1{ font-size:100pt;
            text-align:right;
            color:#eee;
            margin:-40px 0px -50px 0px;
        }
    </style>
        <body>
            <h1>Hello</h1>
            <p>{$msg}</p>
            <p>これはサンプルで作ったページです。</p>
        </body>
    </html>
    EOM;
    
    return $html;

});
