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
		
	}

	public function registration($twitter_handle)
	{

		$validator = Validator::make(Input::all(), User::$user_update_rules);

		$user = User::findByTwitterHandle($user->twitter_handle);
		if ($validator->fails()) 
		{

			Session::flash('errorMessage', $eMessageValue);
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else
		{
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
	
			$user->save();
			$data = [
				'user'=>$user
			];

			Session::flash('successMessage', $messageValue);
			return Redirect::action('UsersController@edit')->with($data);
		}
	}


	//NRS - added 7/20/14 - added showThankYou controller to show the user a thank you message when logging out
	public function showThankYou() {

		return View::make('tweetsforcharity.users_exit_page');
	}

	public function showLogin() {
		return View::make('login');
	}

	public function doLogin() {
		$twitter_handle = Input::get('twitter_handle');
		$password = Input::get('password');
		
		if (Auth::attempt(array('twitter_handle' => $twitter_handle, 'password' => $password)))
		{
    		Session::flash('successMessage', 'You have logged in successfully.');
    		return Redirect::intended(action('UsersController@show', $twitter_handle));
		}
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
		$user = User::find($id);
		$user->donor->charities()->detach(Input::get('charity_id'));
		Session::flash('errorMessage', 'Successfully removed Charity!');
		return Redirect::action('UsersController@edit', $user->twitter_handle);
	}
	public function addCharity()
	{
		// $id = Auth::user()->id;
		$id = Input::get('attach_to_user_id');
		$user = User::find($id);
		$user->donor->charities()->attach(Input::get('charity_id'));
		Session::flash('successMessage', 'Successfully added Charity!');
		return Redirect::action('UsersController@edit', $user->twitter_handle);
	}
}
