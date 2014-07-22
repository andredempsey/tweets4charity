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
	public function store()
	{
		$charity = new Charity();
		$user = new User();

		$messageValue = 'You have successfully registered your charity!';
		$eMessageValue = 'There was a problem registering your charity.';
		
		$validator = Validator::make(Input::all(), User::$user_rules);
		if ($validator->fails()) 
		{
			Session::flash('errorMessage', $eMessageValue);
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else
		{
			
			// if($tweets['error']){
			// 	Session::flash('errorMessage', 'That Twitter account is protected and cannot be registered.');
			// 	return Redirect::back()->withInput()->withInput;
			// } else { 
			// $tweets = Twitter::getUserTimeline(array('screen_name' => $twitter_handle, 'count' => 1, 'format' => 'array'));
			// $profile_image = ($tweets[0]['user']['profile_image_url']);
			// $tweet_count = ($tweets[0]['user']['statuses_count']);
			// $user->profile_picture_link = $profile_image;
			$user->twitter_handle    = Input::get('twitter_handle');
			$user->email             = Input::get('email');
			$user->password          = Hash::make(Input::get('password'));
			$user->role_id           = 'charity';
			$user->is_active         = False;
			$user->save();
			$charity->user_id        = $user->id;
			$charity->charity_name   = Input::get('charity_name');
			$charity->tax_id         = Input::get('tax_id');
			//need to add tax pdf here
			$charity->first_name     = Input::get('first_name');
			$charity->last_name      = Input::get('last_name');
			$charity->phone          = Input::get('phone');
			$charity->street         = Input::get('street');
			$charity->city           = Input::get('city');
			$charity->state          = Input::get('state');
			$charity->zip            = Input::get('zip');
			$charity->save();
			// show msg if charity has been added w/ no errors
			Session::flash('successMessage', $messageValue);
			return Redirect::action('CharitiesController@show');
		
		}
	// }
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($twitter_handle)
	{
		$user = User::find($twitter_handle);
		$data = array(
			'user' => $user);
		return View::make('tweetsforcharity.charity_dashboard')->with($data);
	}

	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($charity_name)
	{
		 $charity = Charity::findByCharityName($charity_name);
		 return View::make('tweetsforcharity.charity_dashboard')->with('charity', $charity);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// 
	}
	// {
	// 	$charity = Post::findOrFail($id);
	// 	$validator = Validator::make(Input::all(), Post::$rules);

	// 	if ($validator->fails())
	// 	{
	// 		// show an error msg if
	// 		Session::flash('errorMessage', 'Sorry, there was an error editing your charity');
	// 		return Redirect::back()->withInput()->withErrors($validator);
	// 	}
	// 	else
	// 	{	
			
	// 		$charity->twitter_handle = Input::get('twitter_handle');
	// 		$charity->charity_name   = Input::get('charity_name');
	// 		$charity->tax_id         = Input::get('tax_id');
	// 		$charity->password       = Input::get('password');
	// 		$charity->first_name     = Input::get('first_name');
	// 		$charity->last_name      = Input::get('last_name');
	// 		$charity->email          = Input::get('email');
	// 		$charity->phone          = Input::get('phone');
	// 		$charity->street         = Input::get('street');
	// 		$charity->city           = Input::get('city');
	// 		$charity->state          = Input::get('state');
	// 		$charity->zip            = Input::get('zip');
	// 		$charity->save();
			
	// 		// show success msg 
	// 		Session::flash('successMessage', 'Your charity information has bee update, Thank You!');
	// 		return Redirect::action('HomeController@showHome');
	// 	}
	// }		

		

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
