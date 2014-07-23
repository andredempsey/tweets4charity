<?php

class CharitiesController extends BaseController {

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
	
		return View::make('tweetsforcharity.charity_dashboard');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		return View::make('tweetsforcharity.charities_sign_up');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($twitter_handle)
	{
		$charity = new Charity();
		//$user = new User();
		$user = findByTwitterHandle($twitter_handle);

		// $messageValue = 'You have successfully registered your charity!';
		// $eMessageValue = 'There was a problem registering your charity.';
		
		// $validator = Validator::make(Input::all(), User::$user_rules);
		// if ($validator->fails()) 
		// {
		// 	Session::flash('errorMessage', $eMessageValue);
		// 	return Redirect::back()->withInput()->withErrors($validator);
		// }
		// else
		// {
			
			// if($tweets['error']){
			// 	Session::flash('errorMessage', 'That Twitter account is protected and cannot be registered.');
			// 	return Redirect::back()->withInput()->withInput;
			// } else { 
			// $tweets = Twitter::getUserTimeline(array('screen_name' => $twitter_handle, 'count' => 1, 'format' => 'array'));
			// $profile_image = ($tweets[0]['user']['profile_image_url']);
			// $tweet_count = ($tweets[0]['user']['statuses_count']);
			// $user->profile_picture_link = $profile_image;
			$user->twitter_handle    = Input::get('twitter_handle');
			$charity->first_name     = Input::get('first_name');
			$charity->last_name      = Input::get('last_name');
			$user->email             = Input::get('email');
			$user->role_id           = 4;
			$user->is_active         = False;
			$user->save();
			$charity->user_id        = $user->id;
			$charity->charity_name   = Input::get('charity_name');
			$charity->tax_id         = Input::get('tax_id');
			//need to add tax pdf here
			$charity->phone          = Input::get('phone');
			$charity->street         = Input::get('street');
			$charity->city           = Input::get('city');
			$charity->state          = Input::get('state');
			$charity->zip            = Input::get('zip');
			$charity->save();
			// show msg if charity has been added w/ no errors
			// Session::flash('successMessage', $messageValue);
			return Redirect::action('CharitiesController@show')->with($twitter_handle);
		
		}
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	
	public function show($twitter_handle)
	{
		$charity = Charity::findByTwitterHandle($twitter_handle);
		$data = array(
			'charity' => $charity);
		
		return View::make('tweetsforcharity.charity_dashboard')->with($data);
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
		$charity = $user->charity;
		
		$data = [
			'user' => $user,
			'charity' =>$charity
		];
		return View::make('tweetsforcharity.charity_dashboard')->with($data);
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
		$charity = $user->charity;

		$data = [
			'user' => $user,
			'charity' =>$charity
		];

		$validator = Validator::make(Input::all(), Charity::$charity_rules);
		//need to figure out how to validate user table data too

		if ($validator->fails())
		{
			// show an error msg if
			Session::flash('errorMessage', 'Sorry, there was an error editing your charity');
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else
		{	
			$user->first_name     = Input::get('first_name');
			$user->last_name      = Input::get('last_name');
			$user->email          = Input::get('email');
			$user->save();

			$charity->charity_name   = Input::get('charity_name');
			$charity->tax_id         = Input::get('tax_id');
			$charity->phone          = Input::get('phone');
			$charity->street         = Input::get('street');
			$charity->city           = Input::get('city');
			$charity->state          = Input::get('state');
			$charity->zip            = Input::get('zip');
			$charity->save();
			
			// show success msg 
			Session::flash('successMessage', 'Your charity information has bee update, Thank You!');
			return View::make('tweetsforcharity.charity_dashboard')->with($data);
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
		//
	}
	
}
