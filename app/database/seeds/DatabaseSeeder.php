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
            $user = new User();
            $user->twitter_handle = "Admin";
            $user->email = "admin" . '@codeup.com';
            $user->role_id = 1;
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
            $user->role_id = 3;
            $user->is_active = True;
            $user->save();
        }
        for ($i=1;$i<=50;$i++)
        {
            $user = new User();
            $user->twitter_handle = $charity_twitter_seed[$i - 1];
            $user->profile_picture_link = "https://pbs.twimg.com/profile_images/2284174758/v65oai7fxn47qv9nectx_400x400.png";
            $user->first_name = $first_name_seed[mt_rand(0,49)];
            $user->last_name = $last_name_seed[mt_rand(0,49)];
            $user->email = $user->first_name . $user->last_name . '@' . $charity_twitter_seed[$i - 1] . '.org';
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
    '808205781',
    '322176030',
    '617100031',
    '589723130',
    '766834973',
    '891358441',
    '883608227',
    '968221615',
    '282338136',
    '000264164',
    '712306212',
    '271100223',
    '550154749',
    '828784369',
    '227949922',
    '508438282',
    '927695499',
    '380906248',
    '035202746',
    '357506292',
    '883230444',
    '542101237',
    '256907481',
    '515927076',
    '373126618',
    '460177366',
    '723617131',
    '589525855',
    '972361376',
    '103107505',
    '286558311',
    '189503820',
    '413522718',
    '229804503',
    '605197292',
    '891255863',
    '391682646',
    '448415069',
    '077901789',
    '144127610',
    '340937563'
];

        for ($i=1;$i<=50;$i++ ) 
        {
            $charity = new Charity();
            $charity->user_id = $i+6;
	        $charity->charity_name = $charity_twitter_seed[$i - 1];
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

class CharityTransactionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('charity_transaction')->delete();
        for ($d=1;$d<=5;$d++) 
        {
            for ($c=1;$c<=5;$c++) 
            {
                $distribution = new CharityTransaction();
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

