<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showHome()
	{
		return View::make('tweetsforcharity.landingpage');

	// 	$tweets = Twitter::getUserTimeline(array('screen_name' => 'pourcraftbeer', 'count' => 20, 'format' => 'array'));
	// 	var_dump($tweets);
	// 	exit();
	// 	//return View::make('tweetsforcharity.landingpage');
		
	}

	public function showLogin() {
		return View::make('login');
	}

	public function doLogin() {
		$twitter_handle = Input::get('twitter_handle');
		$password = Input::get('password');
		// $charity_name = Input::get('charity_name');

		if (Auth::attempt(array('twitter_handle' => $twitter_handle, 'password' => $password)))
		{
    		Session::flash('successMessage', 'You have logged in successfully.');
    		return Redirect::intended(action('UsersController@edit'));
		}
		// else if (Auth::attempt(array('' => $charity_name, 'email' => $email, 'password' => $password), Input::has('remember')))
		// {
		// 	Session::flash('successMessage', 'You have logged in successfully.');
  //   		return Redirect::intended(action('CharitiesController@show'));
		// }
		else
		{
    		Session::flash('errorMessage', 'Email or password was not found.');
    		return Redirect::action('HomeController@showLogin')->withInput();
		}
	}

	public function logout() {
		Auth::logout();
		Session::flash('successMessage', 'You have logged out.');
		return Redirect::action('HomeController@showHome');
	}

	public function removeCharity()
	{
		// $id = Auth::user()->id;
		$id = Input::get('user_id');
		$charity_id = Input::get('charity_id');
		$user = User::find($id)->charities->find($charity_id);
		$charity = $user->charities;
		dd($charity->pivot_is_active);
		// $user->pivot_is_active=False;
		// $user->save();
		// $user->charities()->detach($charityId);
		Session::flash('successMessage', 'Successfully removed Charity!');
		return Redirect::action('UsersController@show', $user->twitter_handle);
	}

}
