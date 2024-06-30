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
    Route::prefix('users')->group(function () {
        Route::get('{id}', 'UsersController@show')->name('user.show');
    });
} else {
    Route::prefix('users')->group(function() {
        Route::get('{id}', [UsersController::class, 'show'])->name('user.show');
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
        });
    } else {
        // 動画
        Route::prefix('movies')->group(function(){
            Route::get('create', [MoviesController::class, 'create'])->name('movie.create');
            Route::post('', [MoviesController::class, 'store'])->name('movie.store');
            Route::delete('{id}', [MoviesController::class, 'destroy'])->name('movie.delete');
        });
    }
});
