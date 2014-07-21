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

		//NRS- added 7/18/14 - testing code for Twitter API
		// $tweets = Twitter::getUserTimeline(array('screen_name' => 'jonbrobinson', 'count' => 20, 'format' => 'array'));
		// var_dump($tweets);
		// var_dump($tweets[0]['user']['name']);
		// var_dump($tweets[0]['user']['statuses_count']);
		// var_dump($tweets[0]['user']['profile_image_url']);
		// exit();
		// return View::make('tweetsforcharity.landingpage');
		
	}

	//NRS - added 7/20/14 - added showThankYou controller to show the user a thank you message when logging out
	public function showThankYou() {
		// dd("testing logout");
		return View::make('tweetsforcharity.users_exit_page');
	}

	public function showLogin() {
		return View::make('login');
	}

	public function doLogin() {
		// if (Input::has('twitter_handle')) {
		// 	// authenticate with twitter
		// } elseif (Input::has('charity_name')) {
		// 	// authenticate with charity_name
		// }
		$twitter_handle = Input::get('twitter_handle');
		$password = Input::get('password');
		//$charity_name = Input::get('charity_name');

		if (Auth::attempt(array('twitter_handle' => $twitter_handle, 'password' => $password)))
		{
    		Session::flash('successMessage', 'You have logged in successfully.');
    		return Redirect::intended(action('UsersController@show', $twitter_handle));
		}
		// else if (Auth::attempt(array('' => $charity_name, 'email' => $email, 'password' => $password), Input::has('remember')))
		// {
		// 	Session::flash('successMessage', 'You have logged in successfully.');
  //   		return Redirect::intended(action('CharitiesController@show'));
		// }
		else
		{
    		Session::flash('errorMessage', 'Twitter handle or password was not found.');
    		return Redirect::action('HomeController@showLogin')->withInput();
		}
	}
	//NRS - refactored 7/20/14 - changed to redirect to show thank you page when logging out
	public function logout() {
		Auth::logout();
		Session::flash('successMessage', 'You have logged out.');
		return Redirect::action('HomeController@showThankYou');
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
