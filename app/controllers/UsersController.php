<?php

class UsersController extends BaseController {

	public function __construct()
	{
    	// call base controller constructor
    	parent::__construct();
    	
    	// run auth filter before all methods on this controller except create and show
    	$this->beforeFilter('auth', array('except' => array('create', 'show', 'store', 'twitter_redirect', 'index')));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  $twitter_handle
	 * @return Response
	 */
	public function show($twitter_handle)
	{
		$user = User::findByTwitterHandle($twitter_handle);
		$tweets = Twitter::statusesUserTimeline($user->user_id);
		$name = ($tweets[0]['user']['name']);
		$statuses_count = ($tweets[0]['user']['statuses_count']);
		$profile_image = ($tweets[0]['user']['profile_image_url_https']);

		$data = [
			'user' => $user,
			'tweets' => $tweets,
			'name' => $name,
			'statuses_count' => $statuses_count,
			'profile_image' => $profile_image
		];

		return View::make('users.show')->with($data);
	}


	/**
	 * Show the User Dashboard form for editing Donor information.
	 *
	 * @param  int  $twitter_handle
	 * @return show User Dashboard with data
	 */
	public function edit($twitter_handle)
	{
		
		//find record in user table using the twitter handle
		$user = User::findByTwitterHandle($twitter_handle);

		$alreadySelectedCharities = [];
		
		//extract charities which belong to Donor
		foreach ($user->donor->charities as $charity)
		{
			$alreadySelectedCharities[]=$charity->id;	
		}

		$charities = array();

		if (empty($alreadySelectedCharities))
		{
			$charities = Charity::paginate(3);
		}
		else
		{
			$charities = Charity::whereNotIn('id', $alreadySelectedCharities)->paginate(3);
		}

		//prepare data for passing to user dashboard view
		$data = [
		'user' => $user,
		'charities' => $charities
		];

		return View::make('users.edit')->with($data);
	}


	/**
	 * Trigger when user clicks 'Update' on User Dashboard View
	 *
	 *
	 * @param  int  $twitter_handle
	 * @return redirect to Edit controller
	 */
	public function update($twitter_handle)
	{

		//find record in user table using the twitter handle
		$user = User::findByTwitterHandle($twitter_handle);

		//initialize the error messages
		$messageValue = 'User information was successfully updated!';
		$eMessageValue = 'There was a problem updating your user information.';

		//check if user is logged in AND (authorized OR admin role)
		if(!(Auth::check() && (Auth::user()->twitter_handle == $user->twitter_handle || Auth::user()->role_id == 'admin')))
		{
			Session::flash('errorMessage', 'Insufficient privileges.');
			return Redirect::action('UsersController@show', $user->twitter_handle);
		}

		//validate the updates meet the rules defined in the UsersController - $user_update_rules
		$validator = Validator::make(Input::all(), User::$user_update_rules);


		if ($validator->fails()) 
		//redirect back to page with sticky values
		{
			Session::flash('errorMessage', $eMessageValue);
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else
		//allow changes to database
		{
			//update fields in users table
			$user->email = Input::get('email');
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');

			//save changes to users table
			$user->save();

			//update fields in donors table
			$user->donor->amount_per_tweet = Input::get('amount_per_tweet');
			$user->donor->report_frequency = Input::get('report_frequency');
			$user->donor->monthly_goal = Input::get('monthly_goal');

			//save changes to donors table
			$user->donor->save();

			Session::flash('successMessage', $messageValue);
			return Redirect::action('UsersController@edit', $user->twitter_handle);
		}
	}
	
}

