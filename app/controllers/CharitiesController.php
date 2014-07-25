<?php

class CharitiesController extends BaseController {

	public function __construct()
	{
    	// call base controller constructor
    	parent::__construct();


    	
    	$this->beforeFilter('auth', array('except' => array('index', 'show')));

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()

	{
		// $charities = DB::table('charities')->get();
		$charities = Charity::with('user')->orderBy('charity_name','ASC')->paginate(9);
		$data = array(
			'charities' => $charities
		);
		// $data = array(
		// 	'charities' => $charities);
		return View::make('charities.index')->with($data);
		
	}

	public function show($twitter_handle)

	{
		$user = User::findByTwitterHandle($twitter_handle);
		$tweets = Twitter::statusesUserTimeline($user->user_id);
		$name = ($tweets[0]['user']['name']);
		$statuses_count = ($tweets[0]['user']['statuses_count']);
		$profile_image = ($tweets[0]['user']['profile_image_url_https']);


		$data = [
			'user' => $user,
			'name' => $name,
			'profile_image' => $profile_image
		];

		return View::make('users.show')->with($data);
	}	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($twitter_handle)
	{
		$user = Auth::user();
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
		$user = Auth::user();
		$charity = $user->charity;

		$data = [
			'user' => $user,
			'charity' =>$charity
		];

		$validator = Validator::make(Input::all(), Charity::$charity_update_rules);
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
