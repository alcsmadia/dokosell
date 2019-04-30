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

Route::get('/', 'MyController@index');

Route::get('/search', 'MyController@search');

Route::get('/add', 'MyController@add');
Route::post('/add', 'MyController@store');
Route::delete('/add/{id}', 'MyController@destroy');

