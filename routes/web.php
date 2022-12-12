<?php

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

Route::get('/chart', 'App\Http\Controllers\AlbumController@handleChart');
Route::get('/album/all', 'App\Http\Controllers\AlbumController@getAllAlbums')->name('album.all');

Route::get('/album/index', 'App\Http\Controllers\AlbumController@getAllAlbumsin')->name('album.index');

Route::get('/album/edit/{id}', 'App\Http\Controllers\AlbumController@edit');

Route::post('/album/edit', 'App\Http\Controllers\AlbumController@update');

Route::post('/album/delete', 'App\Http\Controllers\AlbumController@delete')->name('album.delete');
Route::get('/album/create', 'App\Http\Controllers\AlbumController@create')->name('album.create');
Route::post('/album/store', 'App\Http\Controllers\AlbumController@store')->name('album.store');
Route::get('/album/{id}/add-image', 'App\Http\Controllers\AlbumController@addImage');
Route::post('/album/add-image', 'App\Http\Controllers\AlbumController@storeImage');
Route::post('/album/transfer', 'App\Http\Controllers\AlbumController@getAlbumToTransfer');
// Route::get('/album/album-list-to-transfer/{id}', 'App\Http\Controllers\AlbumController@transfer');
Route::post('/album/delete-with-images', 'App\Http\Controllers\AlbumController@deleteWithImages');
Route::get('/album/transfer-images/{album_from}/{album_to}', 'App\Http\Controllers\AlbumController@transferImages');
Route::get('/image/delete/{id}', 'App\Http\Controllers\AlbumController@deleteImage');
