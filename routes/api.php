<?php

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
    Route::get('/home', 'Api\HomeController@home');
    Route::get('/user', 'Api\UserController@user');
    Route::post('/one_signal', 'Api\UserController@one_signal');
    Route::get('/restaurant/{id}', 'Api\HomeController@restaurant');
    Route::get('/user_settings', 'Api\SettingsController@getUserSettings');
    Route::post('/user_settings', 'Api\SettingsController@updateUserSettings');
    Route::get('/meal_settings', 'Api\SettingsController@getMealSettings');
    Route::post('/meal_settings', 'Api\SettingsController@updateMealSettings');
    Route::post('/visit', 'Api\VisitsController@recordVisit');
    Route::get('/visit', 'Api\VisitsController@getVisits');
});

