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
    //Teams
    Route::get('teams', 'TeamController@index');
    Route::prefix('team')->group(function () {
        Route::get('/{team}', 'TeamController@show');
        Route::post('create', 'TeamController@create');
        Route::post('{team}', 'TeamController@edit');
        Route::delete('{team}', 'TeamController@delete');
    });

    //Players
    Route::get('players/{team?}', 'PlayerController@index');
    Route::prefix('player')->group(function () {
        Route::get('/{player}', 'PlayerController@show');
        Route::post('create', 'PlayerController@create');
        Route::post('{player}', 'PlayerController@edit');
        Route::delete('{player}', 'PlayerController@delete');
    });
});
