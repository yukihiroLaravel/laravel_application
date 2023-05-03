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

// ユーザ新規登録　ｰ>ルーティングに対して命名を行っている、名前で呼び出せる
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ユーザ
Route::get('/', "UsersController@index");
Route::prefix("users")->group(function(){
    Route::get("{id}","UsersController@show")->name("user.show");
});

// ログイン後
Route::group(["middleware" => "auth"], function (){
    // 動画
    Route::prefix("movies")->group(function () {
            Route::get("create", "MoviesController@create")->name("movie.create");
            Route::post("","MoviesController@store")->name("movie.store");
            Route::delete("{id}","MoviesController@destroy")->name("movie.delete");
    });
});




//　練習
// Route::get("hello/{msg?}",function($msg="no massage") {

//     $html =<<< EOM
//     <html>
//     <head>
//     <title>Hello</title>
//     <style>
//         body{font-size:16pt color:#999;}
//         h1{ font-size:100pt;
//             text-align:right;
//             color:#eee;
//             margin:-40px 0px -50px 0px;
//         }
//     </style>
//         <body>
//             <h1>Hello</h1>
//             <p>{$msg}</p>
//             <p>これはサンプルで作ったページです。</p>
//         </body>
//     </html>
//     EOM;
    
//     return $html;

// });
