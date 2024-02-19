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

Route::group(['prefix' => 'movies', 'namespace' => 'Api'], function () {
    Route::get('', 'ApiController@index');//一覧
    Route::get('{id}', 'ApiController@show');//個別
    Route::post('', 'ApiController@store');//登録
    Route::put('{id}', 'ApiController@update');//更新
    Route::delete('{id}', 'ApiController@destroy');//削除
});
