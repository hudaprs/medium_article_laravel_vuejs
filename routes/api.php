<?php

// Ambil Semua Data Artikel
Route::get('articles', 'ArticleController@index');

// Membuat Artikel Baru
Route::post('article', 'ArticleController@store');

// Mengubah Artikel
Route::put('article', 'ArticleController@store');

// Menghapus Artikel
Route::delete('article/{id}', 'ArticleController@destroy');
