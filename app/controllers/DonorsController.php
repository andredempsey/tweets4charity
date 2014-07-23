<?php

class DonorsController extends \BaseController {

	public function removeCharity()
	{
		$user = Auth::user();
		$user->donor->charities()->detach(Input::get('charity_id'));
		Session::flash('errorMessage', 'Successfully removed Charity!');
		return Redirect::action('UsersController@edit', $user->twitter_handle);
	}

	public function addCharity()
	{
		$user = Auth::user();
		$user->donor->charities()->attach(Input::get('charity_id'));
		Session::flash('successMessage', 'Successfully added Charity!');
		return Redirect::action('UsersController@edit', $user->twitterId);
	}

}