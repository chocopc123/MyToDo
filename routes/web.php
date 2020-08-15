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

Route::get('/', 'TodoController@index')->middleware('auth');
Route::get('index_completed', 'TodoController@index_completed')->middleware('auth');

// 絞り込み
Route::prefix('index/refine')->group(function(){
  Route::get('all', 'TodoRefineSortController@index_all')->middleware('auth');
  Route::get('duesoon', 'TodoRefineSortController@duesoon')->middleware('auth');
  Route::get('overdue', 'TodoRefineSortController@overdue')->middleware('auth');
});
// 並べ替え
Route::prefix('index/sort')->group(function(){
  Route::get('created_at', 'TodoRefineSortController@index_created_at')->middleware('auth');
  Route::get('deadline', 'TodoRefineSortController@index_deadline')->middleware('auth');
  Route::get('difficulty', 'TodoRefineSortController@index_difficulty')->middleware('auth');
  Route::get('importance', 'TodoRefineSortController@index_importance')->middleware('auth');
  Route::get('completed_date', 'TodoRefineSortController@index_completed_date')->middleware('auth');
});

Route::prefix('todo')->group(function(){
  Route::get('create', 'TodoController@create')->middleware('auth');
  Route::post('create', 'TodoController@store')->middleware('auth');
  Route::get('edit/{id}', 'TodoController@edit')->middleware('auth');
  Route::post('edit', 'TodoController@update')->middleware('auth');
  Route::get('delete_confirm/{id}', 'TodoController@delete_confirm')->middleware('auth');
  Route::post('delete', 'TodoController@delete')->middleware('auth');
  Route::get('complete_confirm/{id}', 'TodoController@complete_confirm')->middleware('auth');
  Route::post('complete', 'TodoController@complete')->middleware('auth');
  Route::get('release_confirm/{id}', 'TodoController@release_confirm')->middleware('auth');
  Route::post('release', 'TodoController@release')->middleware('auth');
});

Route::prefix('user')->group(function(){
  Route::get('profile', 'UserController@profile')->middleware('auth');
  Route::get('register', 'UserController@register_form')->middleware('guest');
  Route::post('register', 'UserController@register')->middleware('guest');
  Route::get('login', 'UserController@login_form')->middleware('guest');
  Route::post('login', 'UserController@login')->middleware('guest');
  Route::get('logout', 'UserController@logout')->middleware('auth');
  Route::get('user_delete_confirm/{id}', 'UserController@user_delete_confirm')->middleware('auth');
  Route::post('user_delete', 'UserController@user_delete')->middleware('auth');
});

Route::prefix('folder')->group(function(){
  Route::get('create_form', 'FolderController@folder_create_form')->middleware('auth');
  Route::post('create', 'FolderController@folder_create')->middleware('auth');
  Route::get('index/{id}', 'FolderController@folder_index')->middleware('auth');
  Route::get('index_completed/{id}', 'FolderController@folder_index_completed')->middleware('auth');
  Route::get('add_form/{id}', 'FolderController@add_folder_form')->middleware('auth');
  Route::get('add_completed_form/{id}', 'FolderController@add_folder_completed_form')->middleware('auth');
  Route::get('add/{folder_id}/{todo_id}', 'FolderController@add_folder')->middleware('auth');
  Route::get('delete_confirm/{folder_id}', 'FolderController@delete_folder_confirm')->middleware('auth');
  Route::post('delete', 'FolderController@delete_folder')->middleware('auth');
  Route::get('release_confirm/{folder_id}/{todo_id}', 'FolderController@folder_release_confirm')->middleware('auth');
  Route::post('release', 'FolderController@folder_release')->middleware('auth');
});

// フォルダ画面絞り込み
Route::prefix('folder/refine')->group(function(){
  Route::get('all/{folder_id}', 'FolderRefineSortController@folder_index_all')->middleware('auth');
  Route::get('duesoon/{folder_id}', 'FolderRefineSortController@folder_index_duesoon')->middleware('auth');
  Route::get('overdue/{folder_id}', 'FolderRefineSortController@folder_index_overdue')->middleware('auth');
});
// フォルダ画面並べ替え
Route::prefix('folder/sort')->group(function(){
  Route::get('created_at/{folder_id}', 'FolderRefineSortController@folder_index_created_at')->middleware('auth');
  Route::get('deadline/{folder_id}', 'FolderRefineSortController@folder_index_deadline')->middleware('auth');
  Route::get('difficulty/{folder_id}', 'FolderRefineSortController@folder_index_difficulty')->middleware('auth');
  Route::get('importance/{folder_id}', 'FolderRefineSortController@folder_index_importance')->middleware('auth');
  Route::get('completed_date/{folder_id}', 'FolderRefineSortController@folder_index_completed_date')->middleware('auth');
});

// ToDoフォルダ追加画面絞り込み
Route::prefix('folder/add/sort')->group(function(){
  Route::get('all/{folder_id}', 'FolderRefineSortController@add_folder_all')->middleware('auth');
  Route::get('duesoon/{folder_id}', 'FolderRefineSortController@add_folder_duesoon')->middleware('auth');
  Route::get('overdue/{folder_id}', 'FolderRefineSortController@add_folder_overdue')->middleware('auth');
});
// ToDoフォルダ追加画面並べ替え
Route::prefix('folder/add/refine')->group(function(){
  Route::get('created_at/{folder_id}', 'FolderRefineSortController@add_folder_created_at')->middleware('auth');
  Route::get('deadline/{folder_id}', 'FolderRefineSortController@add_folder_deadline')->middleware('auth');
  Route::get('difficulty/{folder_id}', 'FolderRefineSortController@add_folder_difficulty')->middleware('auth');
  Route::get('importance/{folder_id}', 'FolderRefineSortController@add_folder_importance')->middleware('auth');
});