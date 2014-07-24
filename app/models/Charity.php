<?php

class Charity extends BaseModel {

    protected $table = 'charities';

    public static $rules = [
        'first_name'     =>'required|max:100',
        'last_name'      =>'required|max:100',
        'email'          =>'required|email',
        'phone'          =>'required',
        'street'         =>'required',
        'city'           =>'required',
        'state'          =>'required',
        'zip'            =>'required',
        'tax_id'         =>'required',
        'tax_pdf'        =>'required'
    ];

    public static $charity_update_rules = [
        'first_name'     =>'required|max:100',
        'last_name'      =>'required|max:100',
        'email'          =>'required|email',
        'phone'          =>'required',
        'street'         =>'required',
        'city'           =>'required',
        'state'          =>'required',
        'zip'            =>'required',
        'tax_id'         =>'required',
        'tax_pdf'        =>'required', 
    ];
    
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

    public function setPhoneAttribute($value) {
        $value = preg_replace('/\D/', '', $value);
        $this->attributes['phone'] = $value;
    }
}
