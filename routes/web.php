<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/social/github', 'Auth\LoginController@redirectToGithub');
Route::get('/social/github/callback', 'Auth\LoginController@handleGithubCallback');

Route::get('social/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('social/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::get('social/twitter', 'Auth\LoginController@redirectToTwitter');
Route::get('social/twitter/callback', 'Auth\LoginController@handleTwitterCallback');


