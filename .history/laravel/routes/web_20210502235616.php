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

Auth::routes();
// トップページ
Route::get('/', 'PostController@index')->name('posts.index');
// 投稿
Route::resource('posts', 'PostController', ['only' => ['show', 'create', 'store']]);
Route::prefix('posts')->name('posts.')->group(function () {
  Route::get('edit/{id}', 'PostController@edit')->name('edit');
  Route::post('edit', 'PostController@update')->name('update');
  Route::post('delete/{id}', 'PostController@destroy')->name('destroy');
});