<?php

class Charity extends BaseModel {
	//The db table this model relates to
    protected $table = 'charities';

    public function users()
    {
      return $this->belongsToMany('User')->withPivot('alloted_percent');
    }

}
