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

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;

Route::get('/', 'UsersController@index');
Route::get('/practice', 'PracticesController@index');

//ユーザー登録
Route::namespace('Auth')->group(function () {
    Route::get('signup', 'RegisterController@showRegistrationForm')->name('signup');
    Route::post('signup', 'RegisterController@register')->name('signup.post');
});

//ログイン
Route::namespace('Auth')->group(function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login.post');
    Route::get('logout', 'LoginController@logout')->name('logout');
});

//ログインユーザー限定処理
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('movies')->group(function () {
        Route::get('create', 'MoviesController@create')->name('movie.create');
        Route::post('', 'MoviesController@store')->name('movie.store');
        Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');
        Route::get('{id}','MoviesController@edit')->name('movie.edit');
        Route::put('{id}','MoviesController@update')->name('movie.update');
    });

    //お気に入り処理
    Route::group(['prefix' => 'movies/{id}'], function () {
        Route::post('favorite', 'FavoriteController@store')->name('favorite');
        Route::delete('unfavorite', 'FavoriteController@destroy')->name('unfavorite');
    });
});

//ユーザ詳細
Route::get('/', 'UsersController@index');
Route::prefix('users')->group(function () {
    Route::get('{id}', 'UsersController@show')->name('user.show');
});

//todo
Route::get('/todos','TodosController@index')->name('todos.index');
Route::post('/todos','TodosController@store')->name('todos.store');
Route::patch('/todos/{todo}','TodosController@update')->name('todos.update');
Route::delete('/todos/{todo}','TodosController@destroy')->name('todos.destroy');