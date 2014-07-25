<?php

class Activity extends Eloquent {

	//The db table this model relates to
    protected $table = 'activities';


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function donor()
	{
	    return $this->belongsTo('Donor');
	}


	public function summaryByMonth()
	{

		$donor = Auth::user()->donor;
		$donor_id = $donor->id;
		dd($donor->activities->where('donor_id', $donor_id)->groupBy('period')->sum('tweet_count')-get());
	}
}
