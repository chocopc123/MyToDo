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
Route::prefix('index/refine')->group(function(){
  Route::get('all', 'TodoRefineSortController@index_all');
  Route::get('duesoon', 'TodoRefineSortController@duesoon');
  Route::get('overdue', 'TodoRefineSortController@overdue');
});
// 並べ替え
Route::prefix('index/sort')->group(function(){
  Route::get('created_at', 'TodoRefineSortController@index_created_at');
  Route::get('deadline', 'TodoRefineSortController@index_deadline');
  Route::get('difficulty', 'TodoRefineSortController@index_difficulty');
  Route::get('importance', 'TodoRefineSortController@index_importance');
  Route::get('completed_date', 'TodoRefineSortController@index_completed_date');
});

Route::prefix('todo')->group(function(){
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
});

Route::prefix('user')->group(function(){
  Route::get('profile', 'UserController@profile');
  Route::get('register', 'UserController@register_form');
  Route::post('register', 'UserController@register');
  Route::get('login', 'UserController@login_form');
  Route::post('login', 'UserController@login');
  Route::get('logout', 'UserController@logout');
  Route::get('user_delete_confirm/{id}', 'UserController@user_delete_confirm');
  Route::post('user_delete', 'UserController@user_delete');
});

Route::prefix('folder')->group(function(){
  Route::get('create_form', 'FolderController@folder_create_form');
  Route::post('create', 'FolderController@folder_create');
  Route::get('index/{id}', 'FolderController@folder_index');
  Route::get('index_completed/{id}', 'FolderController@folder_index_completed');
  Route::get('add_form/{id}', 'FolderController@add_folder_form');
  Route::get('add_completed_form/{id}', 'FolderController@add_folder_completed_form');
  Route::get('add/{folder_id}/{todo_id}', 'FolderController@add_folder');
  Route::get('delete_confirm/{folder_id}', 'FolderController@delete_folder_confirm');
  Route::post('delete', 'FolderController@delete_folder');
  Route::get('release_confirm/{folder_id}/{todo_id}', 'FolderController@folder_release_confirm');
  Route::post('release', 'FolderController@folder_release');
});

// フォルダ画面絞り込み
Route::prefix('folder/refine')->group(function(){
  Route::get('all/{folder_id}', 'FolderRefineSortController@folder_index_all');
  Route::get('duesoon/{folder_id}', 'FolderRefineSortController@folder_index_duesoon');
  Route::get('overdue/{folder_id}', 'FolderRefineSortController@folder_index_overdue');
});
// フォルダ画面並べ替え
Route::prefix('folder/sort')->group(function(){
  Route::get('created_at/{folder_id}', 'FolderRefineSortController@folder_index_created_at');
  Route::get('deadline/{folder_id}', 'FolderRefineSortController@folder_index_deadline');
  Route::get('difficulty/{folder_id}', 'FolderRefineSortController@folder_index_difficulty');
  Route::get('importance/{folder_id}', 'FolderRefineSortController@folder_index_importance');
  Route::get('completed_date/{folder_id}', 'FolderRefineSortController@folder_index_completed_date');
});

// ToDoフォルダ追加画面絞り込み
Route::prefix('folder/add/sort')->group(function(){
  Route::get('all/{folder_id}', 'FolderRefineSortController@add_folder_all');
  Route::get('duesoon/{folder_id}', 'FolderRefineSortController@add_folder_duesoon');
  Route::get('overdue/{folder_id}', 'FolderRefineSortController@add_folder_overdue');
});
// ToDoフォルダ追加画面並べ替え
Route::prefix('folder/add/refine')->group(function(){
  Route::get('created_at/{folder_id}', 'FolderRefineSortController@add_folder_created_at');
  Route::get('deadline/{folder_id}', 'FolderRefineSortController@add_folder_deadline');
  Route::get('difficulty/{folder_id}', 'FolderRefineSortController@add_folder_difficulty');
  Route::get('importance/{folder_id}', 'FolderRefineSortController@add_folder_importance');
});