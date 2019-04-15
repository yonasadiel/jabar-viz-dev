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

Route::prefix('v1')->group(function () {
    Route::get('/', function() { return 'OK'; });

    Route::middleware('guest')->post('/login', 'AuthenticationController@login');

    Route::get('series', 'SeriesController@index');
    Route::get('series/{id}', 'SeriesController@show');

    Route::get('series/{series_id}/entries', 'EntryController@index');
    Route::get('series/{series_id}/city/{cities_id}/year/{year}/entry', 'EntryController@show');

    Route::middleware('auth')->group(function() {
        Route::get('me', 'AuthenticationController@me');

        Route::post('series', 'SeriesController@store');
        Route::put('series/{id}', 'SeriesController@update');
        Route::patch('series/{id}', 'SeriesController@update');
        Route::delete('series/{id}', 'SeriesController@destroy');

        Route::put('series/{series_id}/city/{cities_id}/year/{year}/entry', 'EntryController@upsert');
        Route::post('series/{series_id}/city/{cities_id}/year/{year}/entry', 'EntryController@upsert');
        Route::patch('series/{series_id}/city/{cities_id}/year/{year}/entry', 'EntryController@upsert');

        Route::middleware('admin')->post('users', 'UserController@store');
    });
});
