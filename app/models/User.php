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

	static public $user_rules = [
    	'first_name'=>'required|max:100',
    	'last_name'=>'required|max:100',
    	'email'=>'required|email',
    	'twitter_handle'=>'required|max:15',
    	'password'=>'required|min:6',
    	'password2'=>'same:password'
    ];

    static public $user_update_rules = [
    	'first_name'=>'required|max:100',
    	'last_name'=>'required|max:100',
    	'email'=>'required|email',
    	'amount_per_tweet'=>'required|numeric|min:0',
    	'report_frequency'=>'required|numeric|integer:7',
    	'monthly_goal'=>'required|numeric|min:0'
    ];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function charities()
	{
	    return $this->belongsToMany('Charity')->withPivot('allotted_percent', 'is_active');
	}

	public function addUploadedImage ($image)
	{
		$systemPath = public_path() . '/' . $this->imgDir . '/';	
		$imageName = $this->id . '-' . $image->getClientOriginalName();
		$image->move($systemPath, $imageName);
		$this->profile_picture_link = '/' . $this->imgDir . '/' . $imageName;
	}

	public function setTwitterHandleAttribute($value)
    {
        $value = str_replace(' ', '-', trim($value));
        $this->attributes['twitter_handle'] = strtolower($value);
    }
    public static function findByTwitterHandle($twitter_handle)
    {
        $user = self::where('twitter_handle', $twitter_handle)->first();
        return ($user == null) ? App::abort(404) : $user;

    }
}
