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

Route::prefix('chat_rooms')->group(function () {
    Route::get('', 'ChatRoomController@index')->name('chat_rooms.index');
    Route::post('', 'ChatRoomController@store')->name('chat_rooms.store');
    Route::get('{chatRoom}', 'ChatRoomController@show')->name('chat_rooms.show');
});


Route::prefix('messages')->group(function () {
    Route::post('', 'MessageController@store')->name('messages.store');
    Route::get('{chatRoom}', 'MessageController@index')->name('messages.index');
});
