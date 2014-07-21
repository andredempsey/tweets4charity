<?php

class Transaction extends Eloquent {

	//The db table this model relates to
    protected $table = 'transactions';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */


	public function users()
	{
	    return $this->belongsTo('User');
	}

	public function distributions()
    {
      return $this->belongsToMany('Charity')->withPivot('amount', 'distributed_on', 'check_sent');
    }

}
