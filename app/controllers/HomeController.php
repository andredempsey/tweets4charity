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
		$index = true;
		return View::make('home.index')->with('index', $index);
	}

	public function showPreLogin()
	{
		return View::make('home.pre-login');
	}

	public function showLogin()
	{
	    // Reqest tokens
	    $tokens = Twitter::oAuthRequestToken();

	    // Redirect to twitter
	    Twitter::oAuthAuthenticate(array_get($tokens, 'oauth_token'));
	    exit;
	}

	public function showRegistration()
	{
		// make sure a user is authenticated
		if (Auth::guest())
		{
			App::abort(404);
		}

		$data = array(
			'user' => Auth::user()
		);

		return View::make('home.registration')->with($data);
	}

	public function doLogin()
	{
	    // Oauth token
	    $token = Input::get('oauth_token');

	    // Verifier token
	    $verifier = Input::get('oauth_verifier');

	    // Request access token
	    $accessToken = Twitter::oAuthAccessToken($token, $verifier);

	    $twitterId = $accessToken['user_id'];
	    $twitterUsername = $accessToken['screen_name'];
	    $twitterToken = $accessToken['oauth_token'];
	    $twitterTokenSecret = $accessToken['oauth_token_secret'];

	    // is this an existing user?
	    $user = User::findByTwitterId($twitterId);

	    if ($user)
	    {
	        // existing user
	        $user->twitter_handle = $twitterUsername;
	        $user->oauth_token = $twitterToken;
	        $user->oauth_token_secret = $twitterTokenSecret;
	        $user->save();
	    }
	    else
	    {
	        // this is a new user, create them in the db
	        $user = new User();
	        $user->role_id = User::ROLE_UNINITIALIZED;
	        $user->user_id = $twitterId;
	        $user->twitter_handle = $twitterUsername;
	        $user->oauth_token = $twitterToken;
	        $user->oauth_token_secret = $twitterTokenSecret;
	        $user->save();
	    }

	    Auth::loginUsingId($user->id);

	    return Redirect::action('UsersController@show', $user->twitter_handle);
	}

	public function logout()
	{
		Auth::logout();
		Session::flash('successMessage', 'You have logged out.');
		return Redirect::action('HomeController@showThankYou');
	}

	public function showThankYou()
	{
		return View::make('home.thankyou');
	}

	public function doRegistration()
	{
		// make sure a user is authenticated
		if (Auth::guest())
		{
			App::abort(404);
		}

		if (Input::get('role_id') == User::ROLE_DONOR)
		{
			// validate donor and create
			$rules = Donor::$rules;

			// if validation fails, redirect back with errors and show on page

			$user = Auth::user();
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->role_id = User::ROLE_DONOR;
			$user->is_active = true;
			$user->save();

			$donor = new Donor();
			$donor->user_id = $user->id;
			$donor->save();

			return Redirect::action('UsersController@show', $user->twitter_handle);
		}
		else if (Input::get('role_id') == User::ROLE_CHARITY)
		{
			// validate charity and create
			// $rules = Charity::$rules;

			$user = Auth::user();
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->role_id = User::ROLE_CHARITY;
			$user->is_active = false;
			$user->save();

			$charity = new Charity();
			$charity->user_id = $user->id;
			$charity->tax_id = Input::get('tax_id');
			$charity->phone = Input::get('phone');
			$charity->street = Input::get('street');
			$charity->city = Input::get('city');
			$charity->state = Input::get('state');
			$charity->zip = Input::get('zip');
			$charity->tax_pdf = Input::get('tax_pdf');
			$charity->save();

			return Redirect::action('UsersController@show', $user->twitter_handle);
		}
		else
		{
			// flash a message, unknown role....
		}

		return Redirect::action('HomeController@showRegistration');
	}

}
