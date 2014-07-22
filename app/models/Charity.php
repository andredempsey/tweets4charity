<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;

class Charity extends BaseModel {

    use UserTrait, RemindableTrait;

	//The db table this model relates to
    protected $table = 'charities';

    // static public $charity_rules = [

        // 'charity_name'   =>'required|max:100',
        // 'tax_id'         =>'required|max:100',
        // 'twitter_handle'=>'required|max:15',
        // 'password'       =>'required|min:6',
        // 'password2'      =>'same:password',
        // 'first_name'     =>'required|max:100',
        // 'last_name'      =>'required|max:100',
        // 'email'          =>'required|email',
        // 'street'         =>'required',
        // 'city'           =>'required',
        // 'state'          =>'required',
        // 'zip'            =>'required',
        //NRS -7/19/14 - commented out b/c form doesn't have a field for uploading pdf and for testing/debug purposes it'd be hard to upload a pdf everytime we want to test or seed
        //'tax_pdf'        =>'required'
    // ];
    // public function users()
    //     'charity_name'   =>'required|max:100',
    //     'tax_id'         =>'required|max:100',
    //     'first_name'     =>'required|max:100',
    //     'last_name'      =>'required|max:100',
    //     'street'         =>'required',
    //     'city'           =>'required',
    //     'state'          =>'required',
    //     'zip'            =>'required'
    //     // 'tax_pdf'        =>'required'
    // ];

    
    public function donors()

    {
        return $this->belongsToMany('Donor')->withPivot('allotted_percent');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function distributions()
    {
      return $this->belongsToMany('Transaction', 'distributions')->withPivot('amount', 'created_at', 'check_sent');

    }
}
