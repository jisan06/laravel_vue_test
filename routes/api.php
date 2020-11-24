<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/services', 'ServiceController@index');
Route::post('/service/store', 'ServiceController@store');
Route::delete('/service/delete/{id}', 'ServiceController@destroy');


Route::get('/passengers', 'PassengerController@index');
Route::get('/passenger/get-services', 'PassengerController@getServices');
Route::any('/passenger/get-services-info', 'PassengerController@getServicesInfo');
Route::post('/passenger/store', 'PassengerController@store');
Route::delete('/passenger/delete/{id}', 'PassengerController@destroy');