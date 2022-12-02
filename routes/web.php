<?php

use App\Http\Controllers\TodoModelController;
use Illuminate\Support\Facades\Route;

Route::GET('/', 'TodoModelController@index')->name('todo');
Route::POST('/delete/{id}', 'TodoModelController@delete')->name('delete');
Route::POST('/destroyall', 'TodoModelController@destroyall')->name('destroyall');
Route::put('/mark/{id}', 'TodoModelController@mark')->name('mark');
Route::post('/create', 'TodoModelController@create')->name('create');
