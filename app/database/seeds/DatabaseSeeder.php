<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('CharityTableSeeder');
		$this->call('CharityUserTableSeeder');
		// $this->call('TransactionTableSeeder');
		// $this->call('DistributionTableSeeder');
	}
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        
            $user = new User();
            $user->twitter_handle = "Admin";
            $user->first_name = "AdminFirst";
            $user->last_name = "AdminLast";
            $user->email = "admin" . '@codeup.com';
            $user->password = Hash::make('adminpassword');
            $user->is_admin = True;
            $user->save();

        for ($i=1;$i<=10;$i++)
        {
        	$user = new User();
        	$user->twitter_handle = "User_Twitter{$i}";
            $user->first_name = "User_First{$i}";
            $user->last_name = "User_Last{$i}";
            $user->email = "User{$i}" . '@codeup.com';
            $user->password = Hash::make('password');
            $user->amount_per_tweet = mt_rand(1,100)/100;
            $user->monthly_goal = mt_rand(100,1000);
            $user->report_frequency = mt_rand(1,30);
            $user->save();
        }
    }

}

class CharityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('charities')->delete();
        for ($i=1;$i<=10;$i++ ) 
        {
            $charity = new Charity();
	        $charity->twitter_handle = "char_twitter{$i}";
	        $charity->charity_name = "Charity{$i}";
	        $charity->tax_id = "tax_id{$i}";
            $charity->first_name = "POCFirstName{$i}";
            $charity->last_name = "POCLasttName{$i}";
            $charity->email = "User{$i}" . '@charity.com';
            $charity->phone = "char_phone{$i}";
            $charity->street = "char_street{$i}";
            $charity->city = "char_city{$i}";
            $charity->state = "char_state{$i}";
            $charity->zip = $i*1000;
            $charity->password = Hash::make('password');
	        $charity->save();
        }
    }

}

class CharityUserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('charity_user')->delete();
        for ($u=2;$u<=11;$u++ ) 
        {
            for ($c=1;$c<=10;$c++ ) 
            {
                $charity_user = new CharityUser();
    	        $charity_user->user_id = $u;
    	        $charity_user->charity_id = $c;
    	        $charity_user->alloted_percent = mt_rand(1,100);
    	        $charity_user->save();
            }
        }
    }

}
