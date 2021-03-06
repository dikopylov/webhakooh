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
Route::post('get-contacts', 'API\ContactController@show');

Route::post('get-scheme', 'API\PlatensSchemeController@show');

Route::post('save-review', 'API\ReviewController@store');

Route::post('is-date-free', 'API\ReservationController@isDateFree');
Route::post('get-free-times', 'API\ReservationController@getFreeTimes');
Route::post('save-reservation', 'API\ReservationController@store');

Route::post('get-free-platens', 'API\PlatenController@getFreePlatens');