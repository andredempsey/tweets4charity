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
		return Redirect::action('UsersController@edit', $user->twitter_handle);
	}

	public function updateAllocation()
	{
	    $charity_id = Input::get('charity_id');
	    $allotted_percent = Input::get('allotted_percent');
	    $donor = Auth::user()->donor;
	    //update pivot value with all
		$donor->charities()->updateExistingPivot($charity_id, array('allotted_percent' => $allotted_percent), false);
	    $message = "Allocation Percent Updated";
	    $error = false;

	    $result = array(
	        'error' => $error,
	        'message' => $message,
	    );

	    return Response::json($result);
	}

}