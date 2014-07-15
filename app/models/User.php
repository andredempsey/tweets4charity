<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'users';

	static public $user_rules = [
    	'firstname'=>'required|max:100',
    	'lastname'=>'required|max:100',
    	'email'=>'required|email',
    	'twitterhandle'=>'required|max:15',
    	'password'=>'required|min:6',
    	'password2'=>'same:password'
    ];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function charities()
	{
	    return $this->belongsToMany('Charity', 'charities_users')->withPivot('alloted_percent');
	}
}
