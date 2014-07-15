<?php

class CharitiesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('charities.index');
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

		// $validator = Validator::make(Input::all(), Post::$rules);

		// if ($validator->fails())
		// {
		// 	Session::flash('errorMessage', 'There was an error setting up your account');
		// 	return Redirect::back()->withInput()->withErrors($validator);
		// }
		// else
		// {	
			$charity = new Charity();

			$charity->charity_id = Auth::charity()->id;
			$charity->twitter_handle = Input::get('twitter_handle');
			$charity->charity_name   = Input::get('charity_name');
			$charity->tax_id         = Input::get('tax_id');
			$charity->password       = Input::get('password');
			$charity->first_name     = Input::get('first_name');
			$charity->last_name      = Input::get('last_name');
			$charity->email          = Input::get('email');
			$charity->phone          = Input::get('phone');
			$charity->street         = Input::get('street');
			$charity->city           = Input::get('city');
			$charity->state          = Input::get('state');
			$charity->zip            = Input::get('zip');
			$charity->save();

			Session::flash('successMessage', 'Your charity has been set up successfully, Thank you!');
			return Redirect::action('HomeController@showHome');
		// }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// $charity = Post::findOrFail($id);
		
		// $validator = Validator::make(Input::all(), Post::$rules);

		// if ($validator->fails())
		// {
		// 	// show an error msg if
		// 	Session::flash('errorMessage', 'Sorry, there was an error editing your charity');
		// 	return Redirect::back()->withInput()->withErrors($validator);
		// }
		// else
		// {	
			
			$charity->twitter_handle = Input::get('twitter_handle');
			$charity->charity_name   = Input::get('charity_name');
			$charity->tax_id         = Input::get('tax_id');
			$charity->password       = Input::get('password');
			$charity->first_name     = Input::get('first_name');
			$charity->last_name      = Input::get('last_name');
			$charity->email          = Input::get('email');
			$charity->phone          = Input::get('phone');
			$charity->street         = Input::get('street');
			$charity->city           = Input::get('city');
			$charity->state          = Input::get('state');
			$charity->zip            = Input::get('zip');
			$charity->save();
			
			// show success msg 
			Session::flash('successMessage', 'Your charity information has bee update, Thank You!');
			return Redirect::action('HomeController@showHome');
		// }
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
