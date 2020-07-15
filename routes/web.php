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

Route::get('/', 'TodoController@index');
Route::get('index_completed', 'TodoController@index_completed');
Route::get('create', 'TodoController@create');
Route::post('create', 'TodoController@store');
Route::get('edit/{id}', 'TodoController@edit');
Route::post('edit', 'TodoController@update');
Route::get('delete_confirm/{id}', 'TodoController@delete_confirm');
Route::post('delete', 'TodoController@delete');
Route::get('complete_confirm/{id}', 'TodoController@complete_confirm');
Route::post('complete', 'TodoController@complete');
Route::get('release_confirm/{id}', 'TodoController@release_confirm');
Route::post('release', 'TodoController@release');

Route::get('register', 'UserController@register_form');
