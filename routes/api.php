<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get("years", 'App\Http\Controllers\BooksController@getReadingYears');
    Route::get("books", 'App\Http\Controllers\BooksController@getAllBooks');
    Route::get("books/year/{year}", 'App\Http\Controllers\BooksController@getBooksByYear');
    Route::post("books", 'App\Http\Controllers\BooksController@insertBook');
    Route::get("book/{id}", 'App\Http\Controllers\BooksController@getBook');
    Route::put("book/{id}", 'App\Http\Controllers\BooksController@updateBook');
    Route::delete("book/{id}", 'App\Http\Controllers\BooksController@deleteBook');
});


