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

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/home', 'Api\HomeController@home');
    Route::get('/restaurant/{id}', 'Api\HomeController@restaurant');
    Route::get('/user_settings', 'Api\SettingsController@getUserSettings');
    Route::post('/user_settings', 'Api\SettingsController@updateUserSettings');
    Route::get('/meal_settings', 'Api\SettingsController@getMealSettings');
    Route::post('/meal_settings', 'Api\SettingsController@updateMealSettings');
});

