<?php

class Charity extends BaseModel {
	//The db table this model relates to
    protected $table = 'charities';

    //Validation rules for our model properties
    // static public $rules = [
    // 	'title'=>'required|max:100',
    // 	'body'=>'required|max:10000'
    // ];



    // public function renderBody()
    // {
    //     // Convert the post body from markdown to HTML using parsedown.
    //     $dirtyHTML = Parsedown::instance()->parse($this->body);
    //     $config = HTMLPurifier_Config::createDefault();
    //     $purifier = new HTMLPurifier($config);
    //     return $purifier->purify($dirtyHTML);
        
    // }

    // Post::recentPosts();
    
    // public static function filteredPosts($searchTitle = null)
    // {
    //     return self::with('user')->where('title', 'LIKE', '%' . $searchTitle . '%')->orderBy('created_at', 'desc')->paginate(4);
    // }

    // public static function countPosts($searchTitle = null)
    // {
    //     return count(self::where('title', 'LIKE', '%' . $searchTitle . '%')->orderBy('created_at', 'desc')->get());
    // }
    public function users()
    {
      return $this->belongsToMany('User', 'selected_charities')->withPivot('alloted_percent');;
    }

}
