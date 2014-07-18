<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Charity extends BaseModel implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

	//The db table this model relates to
    protected $table = 'charities';

    static public $charity_rules = [
        
        'charity_name'   =>'required|max:100',
        'tax_id'         =>'required|max:100',
        'password'       =>'required|min:6',
        'password2'      =>'same:password',
        'first_name'     =>'required|max:100',
        'last_name'      =>'required|max:100',
        'email'          =>'required|email',
        'street'         =>'required',
        'city'           =>'required',
        'state'          =>'required',
        'zip'            =>'required',
    ];
    public function users()
    {

      return $this->belongsToMany('User')->withPivot('allotted_percent', 'is_active');
    }

}
