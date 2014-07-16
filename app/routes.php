<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showHome');

Route::resource('users', 'UsersController');

Route::resource('charities', 'CharitiesController');
Route::resource('/charities_sign_up', 'CharitiesController@create');


Route::get('/public_profile', 'UsersController@showProfile');
Route::get('/users_sign_up', 'UsersController@create');

?>