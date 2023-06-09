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
Route::namespace('Auth')->group(function () {
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'LoginController@login');

});


Route::middleware('auth:api')->group(function () {
    Route::apiResource('countries','CountryController' );
    Route::apiResource('cities', 'CityController');
    Route::apiResource('areas', 'AreaController');
});
