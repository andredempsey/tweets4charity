<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;

class Charity extends BaseModel {

    use UserTrait, RemindableTrait;

	//The db table this model relates to
    protected $table = 'charities';

    // static public $charity_rules = [
        
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
}
