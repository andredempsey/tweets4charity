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
        $this->call('DonorTableSeeder');
		$this->call('CharityTableSeeder');
		$this->call('CharityDonorTableSeeder');
		$this->call('TransactionTableSeeder');
		$this->call('DistributionTableSeeder');
        $this->call('ActivityTableSeeder');
	}
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        
            $user = new User();
            $user->twitter_handle = "Admin";
            $user->email = "admin" . '@codeup.com';
            $user->role_id = 'admin';
            $user->is_active = True;
            $user->save();

        for ($i=1;$i<=5;$i++)
        {
        	$user = new User();
        	$user->twitter_handle = "donor{$i}";
            $user->profile_picture_link = "https://pbs.twimg.com/profile_images/2284174758/v65oai7fxn47qv9nectx_400x400.png";
            $user->first_name = "Donor_First{$i}";
            $user->last_name = "Donor_Last{$i}";
            $user->email = "donor{$i}" . '@codeup.com';
            $user->role_id = 'donor';
            $user->is_active = True;
            $user->save();
        }
        for ($i=1;$i<=5;$i++)
        {
            $user = new User();
            $user->twitter_handle = "charity{$i}";
            $user->profile_picture_link = "https://pbs.twimg.com/profile_images/2284174758/v65oai7fxn47qv9nectx_400x400.png";
            $user->first_name = "Charity{$i}";
            $user->last_name = "Charity{$i}";
            $user->email = "charity{$i}" . '@codeup.com';
            $user->role_id = 'charity';
            $user->is_active = True;
            $user->save();
        }
    }
}

class DonorTableSeeder extends Seeder {

    public function run()
    {
        DB::table('donors')->delete();

        for ($i=1;$i<=5;$i++)
        {
            $donor = new Donor();
            $donor->user_id = $i;
            $donor->amount_per_tweet = mt_rand(1,100)/100;
            $donor->monthly_goal = mt_rand(100,1000);
            $donor->report_frequency = mt_rand(1,30);
            $donor->save();
        }
    }
}


class CharityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('charities')->delete();
        for ($i=1;$i<=5;$i++ ) 
        {
            $charity = new Charity();
            $charity->user_id = $i+6;
	        $charity->charity_name = "Charity{$i}";
	        $charity->tax_id = Hash::make('taxid');
            $charity->phone = "123-456-7890";
            $charity->street = "Some Street";
            $charity->city = "Anywhere";
            $charity->state = "TX";
            $charity->zip = "78111";
	        $charity->save();
        }
    }
}

class CharityDonorTableSeeder extends Seeder {

    public function run()
    {
        DB::table('charity_donor')->delete();
        for ($d=1;$d<=5;$d++) 
        {
            for ($c=1;$c<=5;$c++) 
            {
                $charity_donor = new CharityDonor();
    	        $charity_donor->donor_id = $d;
    	        $charity_donor->charity_id = $c;
    	        $charity_donor->allotted_percent = mt_rand(1,100);
    	        $charity_donor->save();
            }
        }
    }
}

class TransactionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('transactions')->delete();
        for ($d=1;$d<=5;$d++) 
        {
            $transaction = new Transaction();
            $transaction->donor_id = $d;
            $transaction->token = Hash::make('stripe');
            $transaction->amount = mt_rand(50,500);
            $transaction->save();

        }
    }
}

class DistributionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('distributions')->delete();
        for ($d=1;$d<=5;$d++) 
        {
            for ($c=1;$c<=5;$c++) 
            {
                $distribution = new Distribution();
                $distribution->charity_id = $c;
                $distribution->transaction_id = mt_rand(1,5);
                $distribution->amount = 0;
                $distribution->check_sent = False;
                $distribution->save();
            }
        }
    }
}

class ActivityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('activities')->delete();
        for ($a=1;$a<=5;$a++) 
        {
            $activity = new Activity();
            $activity->donor_id = mt_rand(1,5);
            $activity->period = 'June';
            $activity->tweet_count = mt_rand(20,500);
            $activity->save();
        }
    }
}

