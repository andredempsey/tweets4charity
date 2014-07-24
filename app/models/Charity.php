<?php

class Charity extends BaseModel {

    protected $table = 'charities';

    public static $rules = array(
        // 'first_name'     =>'required|max:100',
        // 'last_name'      =>'required|max:100',
        // 'email'          =>'required|email',
        // 'street'         =>'required',
        // 'city'           =>'required',
        // 'state'          =>'required',
        // 'zip'            =>'required',
    );
    
    public function donors()
    {
        return $this->belongsToMany('Donor')->withPivot('allotted_percent');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function transactions()
    {
      return $this->belongsToMany('Transaction')->withPivot('amount', 'created_at', 'check_sent');
    }
}
