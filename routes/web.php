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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\UsersController;

$kouzaflg = true;
if ($kouzaflg) {
    // ユーザ新規登録
    Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
    Route::post('signup', 'Auth\RegisterController@register')->name('signup.post'); 
    
    // ログイン
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login.post');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
} else {
    // ユーザ新規登録
    Route::get('signup', [RegisterController::class, 'showRegistrationForm'])->name('signup');
    Route::post('signup', [RegisterController::class, 'register'])->name('signup.post');

    // ログイン
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
}

Route::get('/', 'UsersController@index');
if ($kouzaflg) {
    Route::group(['prefix' => 'users/{id}'],function(){
        Route::get('', 'UsersController@show')->name('user.show');
        Route::get('favorites','UsersController@favorites')->name('user.favorites');
    });
} else {
    Route::group(['prefix' => 'users/{id}'],function(){
        Route::get('', [UsersController::class, 'show'])->name('user.show');
        Route::get('favorites',[UsersController::class,'favorites'])->name('user.favorites');
    });
}

// ログイン後
Route::group(['middleware' => 'auth'], function() use($kouzaflg) {
    // 動画
    if ($kouzaflg) {
        Route::prefix('movies')->group(function(){
            Route::get('create', 'MoviesController@create')->name('movie.create');
            Route::post('', 'MoviesController@store')->name('movie.store');
            Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');

            // 動画の編集
            Route::get('{id}/edit', 'MoviesController@edit')->name('movie.edit');
            Route::put('{id}', 'MoviesController@update')->name('movie.update');
        });

        // いいね
        Route::group(['prefix' => 'movies/{id}'],function(){
            Route::post('favorite','FavoriteController@store')->name('favorite');
            Route::delete('unfavorite','FavoriteController@destroy')->name('unfavorite');
        });
    } else {
        // 動画
        Route::prefix('movies')->group(function(){
            Route::get('create', [MoviesController::class, 'create'])->name('movie.create');
            Route::post('', [MoviesController::class, 'store'])->name('movie.store');
            Route::delete('{id}', [MoviesController::class, 'destroy'])->name('movie.delete');

            // 動画の編集
            Route::get('{id}/edit', [MoviesController::class, 'edit'])->name('movie.edit');
            Route::put('{id}', [MoviesController::class, 'update'])->name('movie.update');
        });

        // いいね
        Route::group(['prefix' => 'movies/{id}'],function(){
            Route::post('favorite',[FavoriteController::class,'store'])->name('favorite');
            Route::delete('unfavorite',[FavoriteController::class,'destroy'])->name('unfavorite');
        });
    }
});
