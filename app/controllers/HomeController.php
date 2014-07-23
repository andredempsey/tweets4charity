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

	public function twitter_redirect() {
		return View::make('tweetsforcharity.twitter_redirect');
	}

	public function registration($twitter_handle)
	{
		//$twitter_handle = parse_url($url,)

		// $validator = Validator::make(Input::all());

		$token = Input::get('oauth_token');

    	//Verifier/secret token
    	$verifier = Input::get('oauth_verifier');

    	//Request access token
    	$accessToken = PhiloTwitter::oAuthAccessToken($token, $verifier);
    	
		$user = new User;
		$twitter_handle = $accessToken['screen_name'];
    
		$user->twitter_handle = $twitter_handle;
    	$user->oauth_token = $accessToken['oauth_token'];
    	$user->oauth_token_secret = $accessToken['oauth_token_secret'];
    	$user->user_id = $accessToken['user_id'];
    	$user->role_id = 2;
    	$user->save();

		return View::make('tweetsforcharity.sign_up')->with($twitter_handle);


		// $user = User::findByTwitterHandle($twitter_handle);
		// // if ($validator->fails()) 
		// // {

		// // 	Session::flash('errorMessage', $eMessageValue);
		// // 	return Redirect::back()->withInput()->withErrors($validator);
		// // }
		// // else
		// // {
		// 	$user->first_name = Input::get('first_name');
		// 	$user->last_name = Input::get('last_name');
		// 	$user->email = Input::get('email');	
		// 	$user->role_id = 3;
		// 	$user->save();
		// 	$data = [
		// 		'user'=>$user
		// 	];

		// 	// Session::flash('successMessage', $messageValue);
		// 	return Redirect::action('UsersController@edit')->with($data);
		// // }
	}


	//NRS - added 7/20/14 - added showThankYou controller to show the user a thank you message when logging out
	public function showThankYou() {

		return View::make('tweetsforcharity.users_exit_page');
	}

	public function showLogin() {
		return View::make('login');
	}

	// public function doLogin() {
	// 	$twitter_handle = Input::get('twitter_handle');
	// 	$password = Input::get('password');
	// 	//$charity_name = Input::get('charity_name');
	// 	// dd($twitter_handle);
		
	// 	if (Auth::attempt(array('twitter_handle' => $twitter_handle, 'password' => $password)))
	// 	{
 //    		Session::flash('successMessage', 'You have logged in successfully.');
 //    		return Redirect::intended(action('UsersController@show', $twitter_handle));
	// 	}
	// 	else
	// 	{
 //    		Session::flash('errorMessage', 'Twitter handle or password was not found.');
 //    		return Redirect::action('HomeController@showLogin')->withInput();
	// 	}
	// }
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
		return Redirect::action('UsersController@edit', $user->twitterId);
	}
}
