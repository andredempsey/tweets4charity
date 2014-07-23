<?php

class Donor extends Eloquent {

    protected $table = 'donors';

    public static $rules = array(
    	// 	'first_name'=>'required|max:100',
    // 	'last_name'=>'required|max:100',
    // 	// 'email'=>'required|email',
    );


    // static public $user_update_rules = [
    // 	'first_name'=>'required|max:100',
    // 	'last_name'=>'required|max:100',
    // 	// 'email'=>'required|email',
    // 	'amount_per_tweet'=>'required|numeric|min:0',
    // 	'report_frequency'=>'required|numeric|integer:7',
    // 	'monthly_goal'=>'required|numeric|min:0'
    // ];
    
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	/**
	* allows retrieval of user information from the Donor model
	* syntax $donor->user
	* 
	 */
	public function user()
	{
	    return $this->belongsTo('User');
	}

	/**
	* allows retrieval of charity information and join table values from the Donor model
	* syntax $donor->charities
	* 
	 */
	public function charities()
	{
	    return $this->belongsToMany('Charity')->withPivot('allotted_percent');
	}

	/**
	* allows retrieval of charity information and join table values from the Donor model
	* syntax $donor->charities
	* 
	 */
	public function activities()
	{
	    return $this->hasMany('Activity');
	}

	/**
	* allows retrieval of transaction information using the Donor model
	* syntax $donor->transactions
	* 
	*/
	public function transactions()
	{
	    return $this->hasMany('Transaction');
	}

	public function addUploadedImage ($image)
	{
		$systemPath = public_path() . '/' . $this->imgDir . '/';	
		$imageName = $this->id . '-' . $image->getClientOriginalName();
		$image->move($systemPath, $imageName);
		$this->profile_picture_link = '/' . $this->imgDir . '/' . $imageName;
	}

	public static function findByTwitterHandle($twitter_handle)
    {
        $user = User::where('twitter_handle', $twitter_handle)->first();
        return ($user->donor == null) ? App::abort(404) : $user->donor;

    }
}
