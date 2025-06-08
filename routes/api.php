<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// APIのルートを定義
    // 'prefix' => 'movies' は、APIのURLの先頭に 'movies' を付けることを意味する
    // 'namespace' => 'Api' は、コントローラの名前空間を指定する
Route::group(['prefix' => 'movies', 'namespace' => 'Api'], function () {  
    Route::get('', 'ApiController@index');
    Route::get('{id}', 'ApiController@show');
    Route::post('', 'ApiController@store');
    Route::put('{id}', 'ApiController@update');
    Route::delete('{id}', 'ApiController@destroy');
});
