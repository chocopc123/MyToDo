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
// 絞り込み
Route::get('index_all', 'TodoController@index_all');
Route::get('duesoon', 'TodoController@duesoon');
Route::get('overdue', 'TodoController@overdue');
// 並べ替え
Route::get('index_created_at', 'TodoController@index_created_at');
Route::get('index_deadline', 'TodoController@index_deadline');
Route::get('index_difficulty', 'TodoController@index_difficulty');
Route::get('index_importance', 'TodoController@index_importance');

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

Route::get('profile', 'UserController@profile');
Route::get('register', 'UserController@register_form');
Route::post('register', 'UserController@register');
Route::get('login', 'UserController@login_form');
Route::post('login', 'UserController@login');
Route::get('logout', 'UserController@logout');
Route::get('user_delete_confirm/{id}', 'UserController@user_delete_confirm');
Route::post('user_delete', 'UserController@user_delete');

Route::get('folder_create_form', 'FolderController@folder_create_form');
Route::post('folder_create', 'FolderController@folder_create');
Route::get('folder_index/{id}', 'FolderController@folder_index');
Route::get('add_folder_form/{id}', 'FolderController@add_folder_form');
Route::get('add_folder/{folder_id}/{todo_id}', 'FolderController@add_folder');
Route::get('delete_folder_confirm/{folder_id}', 'FolderController@delete_folder_confirm');
Route::post('delete_folder', 'FolderController@delete_folder');