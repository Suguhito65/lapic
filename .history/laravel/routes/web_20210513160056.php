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
// 検索(Routeの位置が投稿の下にあると404になるので注意)
Route::get('posts/search', 'PostController@search')->name('posts.search');
// ユーザー
Route::resource('users', 'UserController', ['only' => 'show']);
// 投稿
Route::resource('posts', 'PostController', ['only' => ['show', 'create', 'store', 'edit']]);
Route::prefix('posts')->name('posts.')->group(function () {
  Route::post('edit', 'PostController@update')->name('update');
  // Route::post('delete/{id}', 'PostController@destroy')->name('destroy');
});