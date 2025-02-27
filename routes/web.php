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

Route::get('tasks', 'TaskController@index')->name('tasks.index');
Route::post('tasks', 'TaskController@store')->name('tasks.store');
Route::delete('tasks/{id}', 'TaskController@destroy')->name('tasks.destroy');


//動画では下記となっていた
//Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
//Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
//Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');