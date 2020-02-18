<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function() {
    Route::get('genres', 'GenreController@index');
    Route::get('authors', 'AuthorController@index');
    Route::prefix('author')->group(function () {
        Route::get('/{author}', 'AuthorController@show');
        Route::post('create', 'AuthorController@create');
        Route::post('{author}', 'AuthorController@edit');
        Route::delete('{author}', 'AuthorController@delete');
    });

    Route::get('books/{author?}', 'BookController@index');
    Route::prefix('book')->group(function () {
        Route::get('/{book}', 'BookController@show');
        Route::post('create', 'BookController@create');
        Route::post('{book}', 'BookController@edit');
        Route::delete('{book}', 'BookController@delete');
    });
});
