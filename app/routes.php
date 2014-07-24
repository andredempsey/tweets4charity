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
Route::get('pre-login', 'HomeController@showPreLogin');
Route::get('login', 'HomeController@showLogin');
Route::get('callback', 'HomeController@doLogin');
Route::get('logout', 'HomeController@logout');
Route::get('registration', 'HomeController@showRegistration');
Route::post('registration', 'HomeController@doRegistration');
Route::get('thankyou', 'HomeController@showThankYou');

Route::get('add-charity', 'DonorsController@addCharity');
Route::get('remove-charity', 'DonorsController@removeCharity');

Route::resource('users', 'UsersController');
Route::resource('charities', 'CharitiesController');

// Route::get('all', 'CharitiesController@index')

?>