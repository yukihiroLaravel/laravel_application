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

use Illuminate\Support\Facades\Route;

Route::get('/','UsersController@index');
Route::get('/practice','PracticesController@index');

//ユーザー登録
Route::namespace('Auth')->group(function(){
    Route::get('signup','RegisterController@showRegistrationForm')->name('signup');
    Route::post('signup','RegisterController@register')->name('signup.post');
});

//ログイン
Route::namespace('Auth')->group(function(){
    Route::get('login','LoginController@showLoginForm')->name('login');
    Route::post('login','LoginController@login')->name('login.post');
    Route::get('logout','LoginController@logout')->name('logout');
});

//ログインユーザー限定処理
Route::group(['middleware' => 'auth'],function(){
    Route::prefix('movies')->group(function(){
        Route::get('create','MoviesController@create')->name('movie.create');
        Route::post('','MoviesController@store')->name('movie.store');
        Route::delete('{id}','MoviesController@destroy')->name('movie.delete');
    });
});

//ユーザ詳細
Route::get('/','UserController@index');
Route::prefix('users')->group(function(){
    Route::get('{id}','UserController@show')->name('user.show');
});