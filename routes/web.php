<?php

use App\Http\Controllers\TodoModelController;
use Illuminate\Support\Facades\Route;

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

Route::GET('/', 'TodoModelController@index')->name('todo');
Route::delete('/delete/{id}', 'TodoModelController@delete')->name('delete');
Route::put('/mark/{id}', 'TodoModelController@mark')->name('mark');
Route::post('/create', 'TodoModelController@create')->name('create');
