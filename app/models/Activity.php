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

}
