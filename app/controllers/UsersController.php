<?php
class UsersController extends BaseController {


public function __construct()
	{
    	// call base controller constructor
    	parent::__construct();

    	//NRS- changed 7/19/14
    	// run auth filter before all methods on this controller except create and show
    	$this->beforeFilter('auth', array('except' => array('create', 'show', 'store')));


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
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tweetsforcharity.users_sign_up');

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$messageValue = 'Successfully registered!';
		$eMessageValue = 'There was a problem registering.';
		$user = new User();
		$donor = new Donor();

		//NRS - 07/20/14 - trying to add tweet count to Activities table; possible new controller needed?
		//$activity = new Activity();

		$validator = Validator::make(Input::all(), User::$user_rules);
		if ($validator->fails()) 
		{
			Session::flash('errorMessage', $eMessageValue);
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else
		{
			//NRS - added 7/19/14
			// use twitter api to check user's twitter account exists
			// if it does, get the user picture, assign it to user object
			// else (it failed), redirect back with error
			$twitter_handle = Input::get('twitter_handle');
			
			// $tweets = Twitter::getUserTimeline(array('screen_name' => $twitter_handle, 'count' => 1, 'format' => 'array'));
			// if($tweets['error']){
			// 	Session::flash('errorMessage', 'That Twitter account is protected and cannot be registered.');
			// 	return Redirect::back()->withInput()->withInput;
			// } else { 
			// 	$profile_image = ($tweets[0]['user']['profile_image_url']);
			// 	$tweet_count = ($tweets[0]['user']['statuses_count']);
			// 	$user->profile_picture_link = $profile_image;
				$user->twitter_handle = Input::get('twitter_handle');
				$user->email = Input::get('email');
				$user->password = Hash::make(Input::get('password'));
				$user->role_id = 'Donor';
				$user->is_active = True;
				$user->save();
				$donor->user_id = $user->id;
				$donor->first_name = Input::get('first_name');
				$donor->last_name = Input::get('last_name');
				$donor->amount_per_tweet = 0;
				$donor->monthly_goal = 0;
				$donor->report_frequency = 30;
				
				$donor->save();
				//$activity->tweet_count = $tweet_count;

				// $activity->save();		

				Session::flash('successMessage', $messageValue);
				return Redirect::action('UsersController@show', $user->twitter_handle);
			}
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
		
;		$user = User::findByTwitterHandle($twitter_handle);
		$tweets = Twitter::getUserTimeline(array('screen_name' => $twitter_handle, 'count' => 1, 'format' => 'array'));
		$name = ($tweets[0]['user']['name']);
		$statuses_count = ($tweets[0]['user']['statuses_count']);
		$profile_image = ($tweets[0]['user']['profile_image_url']);
		$data = [
			'user' => $user,
			'tweets' => $tweets,
			'name' => $name,
			'statuses_count' => $statuses_count,
			'profile_image' => $profile_image
		];
		// var_dump($data);

		return View::make('tweetsforcharity.public_profile')->with($data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($twitter_handle)
	{
		$user = User::findByTwitterHandle($twitter_handle);
		$alreadySelectedCharities = [];
		
		foreach ($user->donor->charities as $charity)
		{
			$alreadySelectedCharities[]=$charity->id;	
		}

		$charities = Charity::whereNotIn('id', $alreadySelectedCharities)->paginate(3);
		$data = [
			'user' => $user,
			'charities' => $charities,
 		];

		return View::make('tweetsforcharity.user_dashboard')->with($data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($twitter_handle)
	{

		$user = User::findByTwitterHandle($twitter_handle);

		$messageValue = 'User information was successfully updated!';
		$eMessageValue = 'There was a problem updating your user information.';


		// if(!(Auth::check() && (Auth::user()->id == $user->twitter_handle || Auth::user()->is_admin)))
		// {
		// 	Session::flash('errorMessage', 'Insufficient privileges.');
		// 	return Redirect::action('UsersController@edit', $user->twitter_handle);
		// }

		$validator = Validator::make(Input::all(), User::$user_update_rules);


		if ($validator->fails()) 
		{

			Session::flash('errorMessage', $eMessageValue);
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else
		{
			$user->email = Input::get('email');
			$user->donor->first_name = Input::get('first_name');
			$user->donor->last_name = Input::get('last_name');
			$user->donor->amount_per_tweet = Input::get('amount_per_tweet');
			$user->donor->report_frequency = Input::get('report_frequency');
			$user->donor->monthly_goal = Input::get('monthly_goal');
			$user->save();
			$user->donor->save();	

			// if(Input::hasFile('image') && Input::file('image')->isValid())
			// {
			// 	$user->addUploadedImage(Input::file('image'));
			// 	$user->save();
			// }

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
	public function destroy($id)
	{
		return make::View('users.destroy');
	}

	
}

