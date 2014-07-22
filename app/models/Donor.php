<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;

class Donor extends Eloquent {


	use UserTrait, RemindableTrait;

	//The db table this model relates to
    protected $table = 'donors';


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

	public function user()
	/**
	* allows retrieval of user information from the Donor model
	* syntax $donor->user
	* 
	 */
	{
	    return $this->belongsTo('User');
	}

	public function charities()
	/**
	* allows retrieval of charity information and join table values from the Donor model
	* syntax $donor->charities
	* 
	 */
	{
	    return $this->belongsToMany('Charity')->withPivot('allotted_percent');
	}

	public function activities()
	/**
	* allows retrieval of charity information and join table values from the Donor model
	* syntax $donor->charities
	* 
	 */
	{
	    return $this->hasMany('Activity');
	}

	public function transactions()
	/**
	* allows retrieval of transaction information using the Donor model
	* syntax $donor->transactions
	* 
	*/
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
