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

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ログイン後
Route::group(['middleware' => 'auth'], function () {
    // 動画
    Route::prefix('movies')->group(function () {
        Route::get('create', 'MoviesController@create')->name('movie.create');
        Route::post('', 'MoviesController@store')->name('movie.store');
        Route::delete('{id}', 'MoviesController@destroy')->name('movie.delete');
        Route::get('{id}/edit', 'MoviesController@edit')->name('movie.edit');
        Route::put('{id}', 'MoviesController@update')->name('movie.update');
    });
    // いいね
    Route::group(['prefix' => 'movies/{id}'],function(){
        Route::post('favorite','FavoriteController@store')->name('favorite');
        Route::delete('unfavorite','FavoriteController@destroy')->name('unfavorite');
    });
});

// コメント関連のルートを定義
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('movies/{id}')->group(function () {
        // コメント一覧表示
        Route::get('comments', 'CommentsController@index')->name('movie.comment');
        // コメント投稿
        Route::post('comments', 'CommentsController@store')->name('comment.store');
        // コメント編集
        Route::put('comments/{comment_id}', 'CommentsController@update')->name('comment.update');
        // コメント削除
        Route::delete('comments/{comment_id}', 'CommentsController@destroy')->name('comment.delete');
    });
});

// コメント一覧はログイン不要で表示
Route::get('movies/{id}/comments', 'CommentsController@index')->name('movies.comments');


// ユーザ
Route::get('/', 'UsersController@index')->name('users');
Route::group(['prefix' => 'users/{id}'],function(){
    Route::get('', 'UsersController@show')->name('user.show');
    Route::get('favorites','UsersController@favorites')->name('user.favorites');
});

// ユーザプロファイル
Route::middleware(['auth'])->group(function () {
    Route::get('profile/edit', 'UsersController@edit')->name('profile.edit');
    Route::put('profile/update', 'UsersController@update')->name('profile.update');
});
Route::get('profile/{id}', 'UsersController@showProfile')->name('profile.showProfile');

//プロファイル写真削除
use App\Http\Controllers\UsersController;

Route::delete('/profile/delete-picture', [UsersController::class, 'deletePicture'])->name('profile.deletePicture');

//プロファイル写真更新と即表示
Route::post('/profile/upload-picture', [UsersController::class, 'uploadPicture'])->name('profile.uploadPicture');

//ユーザー退会
Route::delete('/users/{id}', 'UsersController@destroy')->name('users.destroy')->middleware('auth');

//パスワード変更
Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', 'PasswordController@showChangePasswordForm')->name('auth.changePassword');
    Route::post('/change-password', 'PasswordController@updatePassword')->name('password.update');
});

//E-mail認証
Route::post('/user/send-verification', 'VerificationController@send')->name('user.sendVerification');
Route::get('/user/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');

//検索
Route::get('movies/search', 'MoviesController@search')->name('movies.search');
