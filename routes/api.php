<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Ambil Semua Data Artikel
Route::get('articles', 'ArticleController@index');

// Membuat Artikel Baru
Route::post('article', 'ArticleController@store');

// Mengambil Satu Artikel
Route::get('article/{id}', 'ArticleController@show');

// Mengubah Artikel
Route::put('article/{id}', 'ArticleController@update');

// Menghapus Artikel
Route::delete('article/{id}', 'ArticleController@destroy');
