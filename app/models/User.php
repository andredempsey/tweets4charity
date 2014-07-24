<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	//The db table this model relates to

    public static $user_rules = [
    	'first_name'=>'required|max:100',
    	'last_name'=>'required|max:100',
    	'email'=>'required|email',
    	'twitter_handle'=>'required|max:15',
    	'password'=>'required|min:6'
    ];

    public static $user_update_rules = [
    	'first_name'=>'required|max:100',
    	'last_name'=>'required|max:100',
    	'email'=>'required|email',
    	'amount_per_tweet'=>'required|numeric|min:0',
    	'report_frequency'=>'required|numeric|integer:7',
    	'monthly_goal'=>'required|numeric|min:0'
    ];

    const ROLE_ADMIN = 1;
    const ROLE_UNINITIALIZED = 2;
    const ROLE_DONOR = 3;
    const ROLE_CHARITY = 4;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public function donor()
	/**
	* allows retrieval of donor information from the User model
	* syntax $user->donor
	* works
	 */
	{
	    return $this->hasOne('Donor');
	}
	
 	public function charities()
    /**
	* allows retrieval of all charities related to a Donor User from the User model
	* syntax $user->charities
	* works??
	 */
    {
      return $this->belongsToMany('Charity');
	}
	public function charity()
		/**
	* allows retrieval of charity information from the User model
	* syntax $user->charity
	* works
	 */
	{
	    return $this->hasOne('Charity');
	}
	public function transactions()
	/**
	* allows retrieval of transaction information from the User model
	* syntax $user->transactions
	* does not work
	 */
	{
	    return $this->hasMany('Transaction');
	}

	public function activities()
	/**
	* allows retrieval of donor information from the User model
	* syntax $user->donor
	* does not work
	 */
	{
	    return $this->hasMany('Activity');
	}

    public static function findByTwitterHandle($twitter_handle)
    {
        $user = self::where('twitter_handle', $twitter_handle)->first();
        return ($user == null) ? App::abort(404) : $user;

    }

    public static function findByTwitterId($twitterId)
    {
        return self::where('user_id', $twitterId)->first();
    }
}
