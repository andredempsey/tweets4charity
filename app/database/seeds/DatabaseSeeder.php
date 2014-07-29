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
		$this->call('CharityTransactionTableSeeder');
        $this->call('ActivityTableSeeder');
	}
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        

$first_name_seed = [
    'Ben',
    'Jim',
    'Sara',
    'Amber',
    'Amanda',
    'Jessica',
    'Jack',
    'Steve',
    'Greg',
    'Justin',
    'Travis',
    'David',
    'Lucy',
    'Madison',
    'Mike',
    'Jennifer',
    'Josie',
    'Chris',
    'Jason',
    'Crystal',
    'Alora',
    'Christine',
    'Samantha',
    'Mary',
    'Gaby',
    'Diego',
    'Adam',
    'Noel',
    'Yvone',
    'Kevin',
    'Cassandra',
    'Ryan',
    'Randy',
    'Robert',
    'Deann',
    'Xavier',
    'Dolores',
    'Terri',
    'Cindy',
    'Tricia',
    'Roger',
    'Rose',
    'Brian',
    'Caitlin',
    'Carolyn',
    'Dawna',
    'Don',
    'Douglas',
    'Fernando',
    'Gavin',
    'Jimmy',
    'Jodi',
    'Jolene',
    'Joseph',
    'Katy',
    'Kristina',
    'Leslie',
    'Lidia',
    'Lindsey',
    'Nick',
    'Nicole',
    'Patrick',
    'Raul',
    'Tommy',
    'Lauren',
    'Tony',
    'Valarie'

];

$last_name_seed = [
    'Brown',
    'Miranda',
    'Escobar',
    'Garza',
    'Garcia',
    'Galindo',
    'Wynn',
    'Donovan',
    'Morales',
    'Martinez',
    'Rodriguez',
    'Davis',
    'Davies',
    'Mello',
    'James',
    'Robinson',
    'Burns',
    'Wright',
    'Larson',
    'Gomez',    
    'Alfaro',
    'Ramirez',
    'Foss',
    'Mullin',
    'Stout',
    'Medlock',
    'Nelson',
    'Mills',
    'Green',
    'Duncan',
    'Kidd',
    'Banda',
    'Lopez',
    'Queen',
    'Howard',
    'Perez',
    'Landers',
    'Johnson',
    'Jones',
    'Williams',
    'Tilson',
    'Wilson',
    'Harris',
    'White',
    'Martin',
    'Lee',
    'Lewis',
    'Walker',
    'Hall',
    'Allen',
    'Young',
    'Hernandez',
    'King',
    'Hill',
    'Scott',
    'Mitchell',
    'Roberts',
    'Phillips',
    'Campbell',
    'Reed',
    'Cook',
    'Bell',
    'Cooper'
];

$charity_twitter_seed = [
    'RedCross',
    'AmericaCancer',
    'C2CPhylly',
    'safoodbank',
    'wwpinc',
    'Silver_BlackCR',
    'su2c',
    'officalpeta',
    'livestrong',
    'RMHC',
    'llsusa',
    'PeaceCorps',
    'nokidhungry',
    'SA2020',
    'BGCA_Clubs',
    'KiddsKids',
    'the1010project',
    'anitaborg_org',
    'createthegood',
    'Exploratorium',
    'Greenpeace_Intl',
    'humanesociety',
    'thelampnyc',
    'NWF',
    'savethechildren',
    'WWF_Climate',
    'StJude',
    'haritywater',
    'giftcardgiver',
    'TOMSshoes',
    'USFWSPacific',
    'IUCN',
    'RnfrstAlliance',
    'ReeveFoundation',
    'TheVFoundation',
    'AHASanAntonio',
    'isherHouseWH',
    'AlamoAreaBSA',
    'GirlScoutsSWTX',
    'goodwillsa',
    'HabitatSATX',
    'HavenForHope',
    'JuniorLeagueSA',
    'MarchofDimes',
    'MilitaryChild',
    'maddonline',
    'PaseodelRio',
    'salarmysatx',
    'SAMMinistries',
    'SAKIDS',
    'sahumane'
];

$picture = [
"",
"",
"",
"",
"",
"",
"",
"",
"",
""


];
            $user = new User();
            $user->twitter_handle = "Admin";
            $user->email = "admin" . '@codeup.com';
            $user->role_id = 1;
            $user->is_active = True;
            $user->save();

        for ($i=0;$i<=9;$i++)
        {
        	$first = $first_name_seed[mt_rand(0,40)];
            $last = $last_name_seed[mt_rand(0,40)];
            $user = new User();
        	$user->twitter_handle = "donor{$i}";
            $user->profile_picture_link = $picture[$i];
            $user->first_name = $first;
            $user->last_name = $last;
            $user->email = $first.$last . '@gmail.com';
            $user->role_id = 4;
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
        

$charity_twitter_seed = [
    'RedCross',
    'AmericaCancer',
    'C2CPhylly',
    'safoodbank',
    'wwpinc',
    'Silver_BlackCR',
    'su2c',
    'officalpeta',
    'livestrong',
    'RMHC',
    'llsusa',
    'PeaceCorps',
    'nokidhungry',
    'SA2020',
    'BGCA_Clubs',
    'KiddsKids',
    'the1010project',
    'anitaborg_org',
    'createthegood',
    'Exploratorium',
    'Greenpeace_Intl',
    'humanesociety',
    'thelampnyc',
    'NWF',
    'savethechildren',
    'WWF_Climate',
    'StJude',
    'haritywater',
    'giftcardgiver',
    'TOMSshoes',
    'USFWSPacific',
    'IUCN',
    'RnfrstAlliance',
    'ReeveFoundation',
    'TheVFoundation',
    'AHASanAntonio',
    'isherHouseWH',
    'AlamoAreaBSA',
    'GirlScoutsSWTX',
    'goodwillsa',
    'HabitatSATX',
    'HavenForHope',
    'JuniorLeagueSA',
    'MarchofDimes',
    'MilitaryChild',
    'maddonline',
    'PaseodelRio',
    'salarmysatx',
    'SAMMinistries',
    'SAKIDS',
    'sahumane'
];


$tax_id_seed = [

    '865438390',
    '218765194',
    '559856916',
    '293437421',
    '435679686',
    '860544909',
    '388192022',
    '625967373',
    '050431234',
    '808205781'
];

        for ($i=1;$i<=10;$i++ ) 
        {
            $charity = new Charity();
            $charity->user_id = $i;
	        $charity->charity_name = $charity_twitter_seed[$i-1];
	        $charity->tax_id = $tax_id_seed[$i - 1];
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
        
    }
}

class TransactionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('transactions')->delete();
        for ($d=1;$d<=3;$d++) 
        {
            $transaction = new Transaction();
            $transaction->donor_id = 11;
            $transaction->token = Hash::make('stripe');
            $transaction->amount = mt_rand(50,500);
            $transaction->amount_per_tweet = 0.20;
            $transaction->save();

        }
    }
}

class CharityTransactionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('charity_transaction')->delete();
    }
}

class ActivityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('activities')->delete();
        $period = ['April 2014', 'May 2014', 'June 2014', 'July 2014'];
        $tweet_count = [100, 150, 275, 345];
        $is_paid = [1,1,1,0];

        for ($a=1;$a<=5;$a++) 
        {
            $activity = new Activity();
            $activity->donor_id = 1;
            $activity->period = $period[$a];
            $activity->tweet_count = $tweet_count[$a];
            $activity->is_paid = $is_paid[$a];
            $activity->save();
        }
    }

}

