<?php
class UsersController extends BaseController {


public function __construct()
	{
    	// call base controller constructor
    	parent::__construct();

    	//NRS- changed 7/19/14
    	// run auth filter before all methods on this controller except create and show
    	$this->beforeFilter('auth', array('except' => array('create', 'show', 'store', 'twitter_redirect', 'index')));

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		
		return View::make('tweetsforcharity.public_profile');
	}


	/**
	 * Show the User Sign Up Form.
	 *
	 * @return User Sign Up Form
	 */
	

	public function create()
	{
		// Oauth tokends
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
    	

		return View::make('tweetsforcharity.sign_up')->with('user', $user);

	}


	/**
	 * Store a new user in the users and donors tables.
	 *
	 * @return Response
	 */
	public function store($twitter_handle)
	{
		// $messageValue = 'Successfully registered!';
		// $eMessageValue = 'There was a problem registering.';

		$user = findByTwitterHandle($twitter_handle);

		// $user = new User();
		// $donor = new Donor();
		//$twitter_handle = parse_url($url,)

		// $validator = Validator::make(Input::all());

		
		// if ($validator->fails()) 
		// {

		// 	Session::flash('errorMessage', $eMessageValue);
		// 	return Redirect::back()->withInput()->withErrors($validator);
		// }
		// else
		// {
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');	
			$user->role_id = 3;
			$user->save();
			$data = [
				'user'=>$user
			];

			// Session::flash('successMessage', $messageValue);
			return Redirect::action('UsersController@edit')->with($data);
		// }


		//NRS - 07/20/14 - trying to add tweet count to Activities table; possible new controller needed?
		//$activity = new Activity();

		// $validator = Validator::make(Input::all(), User::$user_rules);
		// if ($validator->fails()) 
		// {
		// 	Session::flash('errorMessage', $eMessageValue);
		// 	return Redirect::back()->withInput()->withErrors($validator);
		// }
		// else
		// {
			//NRS - added 7/19/14
			// use twitter api to check user's twitter account exists
			// if it does, get the user picture, assign it to user object
			// else (it failed), redirect back with error

			// if($tweets['error']){
			// 	dd($tweets);
			// 	Session::flash('errorMessage', 'That Twitter account is protected and cannot be registered.');
			// 	return Redirect::back()->withInput()->withInput;
			// else { 
			// 	$user->first_name = Input::get('first_name');
			// 	$user->last_name = Input::get('last_name');
			// 	$user->email = Input::get('email');
			// 	//$user->twitter_handle = Input::get('twitter_handle');
			// 	$user->password = Hash::make(Input::get('password'));
			// 	//$user->profile_picture_link = $profile_image;
			// 	// $tweets = Twitter::getUserTimeline(array('screen_name' => $twitter_handle, 'count' => 1, 'format' => 'array'));
			// 	// $profile_image = ($tweets[0]['user']['profile_image_url']);
			// 	// $tweet_count = ($tweets[0]['user']['statuses_count']);
			// 	//$user->tokens = 
			// 	$user->role_id = 'donor';
			// 	$user->is_active = True;
			// 	//dd($user);
			// 	// $activity->tweet_count = $tweet_count;
			// 	$user->save();
			// 	//$activity->save();		

			// 	$twitter_handle = Input::get('twitter_handle');
				
			// 	// $tweets = Twitter::getUserTimeline(array('screen_name' => $twitter_handle, 'count' => 1, 'format' => 'array'));
			// 	// if($tweets['error']){
			// 	// 	Session::flash('errorMessage', 'That Twitter account is protected and cannot be registered.');
			// 	// 	return Redirect::back()->withInput()->withInput;
			// 	// } else { 
			// 	// 	$profile_image = ($tweets[0]['user']['profile_image_url']);
			// 	// 	$tweet_count = ($tweets[0]['user']['statuses_count']);
			// 	// 	$user->profile_picture_link = $profile_image;
			// 	$user->twitter_handle = Input::get('twitter_handle');
			// 	$user->email = Input::get('email');
			// 	$user->password = Hash::make(Input::get('password'));
			// 	$user->role_id = 'Donor';
			// 	$user->is_active = True;
			// 	$user->save();
			// 	// $donor->user_id = $user->id;
			// 	// $donor->first_name = Input::get('first_name');
			// 	// $donor->last_name = Input::get('last_name');
			// 	// $donor->amount_per_tweet = 0;
			// 	// $donor->monthly_goal = 0;
			// 	// $donor->report_frequency = 30;
				
			// 	// $donor->save();
			// 	//$activity->tweet_count = $tweet_count;

			// 	// $activity->save();

			// 	Session::flash('successMessage', $messageValue);
			// 	return Redirect::action('UsersController@showHome');
			// }
		}
	
	public function oauth() {	

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  $twitter_handle
	 * @return Response
	 */
	public function show($twitter_handle)
	{
		//NRS - added 7/19/14
		$user = User::findByTwitterHandle($twitter_handle);
		$tweets = Twitter::getUserTimeline(array('screen_name' => $twitter_handle, 'count' => 1, 'format' => 'array'));
		$name = ($tweets[0]['user']['name']);
		$statuses_count = ($tweets[0]['user']['statuses_count']);
		$profile_image = ($tweets[0]['user']['profile_image_url_https']);
		$data = [
			'user' => $user,
			//'tweets' => $tweets,
			'name' => $name,
			'statuses_count' => $statuses_count,
			'profile_image' => $profile_image
		];
		return View::make('tweetsforcharity.public_profile')->with($data);
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

		$charities = Charity::whereNotIn('id', $alreadySelectedCharities)->paginate(3);

		//prepare data for passing to user dashboard view
		$data = [
		'user' => $user,
		'charities' => $charities
		];
		return View::make('tweetsforcharity.user_dashboard')->with($data);
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($twitter_handle)
	{
		return make::View('users.destroy');
	}

	
}

