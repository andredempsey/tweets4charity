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
    'AmericanCancer',
    'safoodbank',
    'wwpinc',
    'Silver_BlackCR',
    'su2c',
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
    'StJude',
    'giftcardgiver',
    'TOMSshoes',
    'USFWSPacific',
    'IUCN',
    'RnfrstAlliance',
    'ReeveFoundation',
    'TheVFoundation',
    'AHASanAntonio',
    'FisherHouseWH',
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

$charity_pic_url = [

    'https://pbs.twimg.com/profile_images/445539103749066752/tVBwZC9E.jpeg',
    'https://pbs.twimg.com/profile_images/446718335128850432/0x1ZLqwg.png',
    'https://pbs.twimg.com/profile_images/378800000534899092/8589f5bf158c0188c27ef671dc305948.jpeg',
    'https://pbs.twimg.com/profile_images/956793187/Logo_thumb_black.png',
    'https://pbs.twimg.com/profile_images/493846596165963776/H8C26ov2.jpeg',
    'https://pbs.twimg.com/profile_images/484090644931948545/clmachcj.jpeg',
    'https://pbs.twimg.com/profile_images/472043355963006976/MjRINlxF.jpeg',
    'https://pbs.twimg.com/profile_images/476765519282855936/VpoAce0J.jpeg',
    'https://pbs.twimg.com/profile_images/461196115417636864/UIzqPyNH.png',
    'https://pbs.twimg.com/profile_images/458687520222375936/0AMhh5Tg.png',
    'https://pbs.twimg.com/profile_images/378800000794358992/84b1b0bcfcbed346b32f8179d227ced2.jpeg',
    'https://pbs.twimg.com/profile_images/428163746750402560/NNUmHjNJ.jpeg',
    'https://pbs.twimg.com/profile_images/492363819406995456/QPRgTBxS.jpeg',
    'https://pbs.twimg.com/profile_images/672061082/KiddsKids_Logo.jpg',
    'https://pbs.twimg.com/profile_images/139481660/1010_logo_black.png',
    'https://pbs.twimg.com/profile_images/3117636418/997f1fb6271d929f6e06664885eb06be.png',
    'https://pbs.twimg.com/profile_images/450738134326583297/vl662WxA.jpeg',
    'https://pbs.twimg.com/profile_images/2798232670/9341d8240cfe0a6bdfa357b60ee4eb32.jpeg',
    'https://pbs.twimg.com/profile_images/413495535786409984/Wi1XSqPv.png',
    'https://pbs.twimg.com/profile_images/427917467470422016/sYEbsLc-.jpeg',
    'https://pbs.twimg.com/profile_images/80695432/Logo_square.jpg',
    'https://pbs.twimg.com/profile_images/433811006792269824/D43eGB9F.jpeg',
    'https://pbs.twimg.com/profile_images/482226720066392065/NhTCkq3i.jpeg',
    'https://pbs.twimg.com/profile_images/458696305070444544/CcdwA28o.jpeg',
    'https://pbs.twimg.com/profile_images/701726309/twitterProfilePhoto.jpg',
    'https://pbs.twimg.com/profile_images/1380128558/Screen_shot_2011-06-03_at_6.13.50_AM.png',
    'https://pbs.twimg.com/profile_images/469174221017333760/wPv7fcSZ.jpeg',
    'https://pbs.twimg.com/profile_images/1900656672/iucn.png',
    'https://pbs.twimg.com/profile_images/1939578294/RA_square_2.jpg',
    'https://pbs.twimg.com/profile_images/459111368998653952/Hv-gORZs.png',
    'https://pbs.twimg.com/profile_images/493787540768292864/zaeumcMk.jpeg',
    'https://pbs.twimg.com/profile_images/1195892398/san_ant_citybutton.jpg',
    'https://pbs.twimg.com/profile_images/1245383056/Patch_III_copy.jpg',
    'https://pbs.twimg.com/profile_images/3480596237/53a9713b436e089f3de49def069ab346.jpeg',
    'https://pbs.twimg.com/profile_images/1804307975/44913_441547651605_69288446605_5851421_428345_n.jpg',
    'https://pbs.twimg.com/profile_images/474555361530093569/Iq0I7NYI.jpeg',
    'https://pbs.twimg.com/profile_images/3560567933/18176b28963bab1f4e32abee7852b4d9.jpeg',
    'https://pbs.twimg.com/profile_images/792889116/missionstatement.png',
    'https://pbs.twimg.com/profile_images/473590205887156225/9PM1KWDl.jpeg',
    'https://pbs.twimg.com/profile_images/2631575626/9ad6ea253cdee0a1bfdf229cf9e248cd.png',
    'https://pbs.twimg.com/profile_images/492680620686848000/KFsxx3Xo.jpeg',
    'https://pbs.twimg.com/profile_images/2811175821/74cfe2d9ec1eecbc7d69d792dfac5e12.png',
    'https://pbs.twimg.com/profile_images/974804606/RW_barge_twitter.jpg',
    'https://pbs.twimg.com/profile_images/378800000679390671/ab0130edfa3267bf848cbd461187a645.jpeg',
    'https://pbs.twimg.com/profile_images/419203107164151808/tLXwH1VM.jpeg',
    'https://pbs.twimg.com/profile_images/489447996048699393/CXhVUAE7.jpeg',
    'https://pbs.twimg.com/profile_images/2241552434/twittycat2_2012.jpg'
   ]; 
            
        for ($i=1;$i<=46;$i++)
        {
        	$first = $first_name_seed[mt_rand(0,40)];
            $last = $last_name_seed[mt_rand(0,40)];
            $user = new User();
            $user->twitter_handle = $charity_twitter_seed[$i - 1];
            $user->profile_picture_link = $charity_pic_url[$i - 1];
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
    }
}


class CharityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('charities')->delete();
        
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
    '865438391',
    '218765192',
    '559856913',
    '293437424',
    '435679685',
    '860544906',
    '388192027',
    '625967378',
    '050431239',
    '808205782',
    '965438390',
    '118765194',
    '259856916',
    '393437421',
    '535679686',
    '660544909',
    '788192022',
    '825967373',
    '950431234',
    '818205781',
    '875438391',
    '228765192',
    '569856913',
    '239437424',
    '445679685',
    '870544906',
    '398192027',
    '635967378',
    '060431239',
    '818205782',
    '228715192',
    '569816913',
    '239417424',
    '445619685',
    '870514906',
    '398112027',
    '635917378',
    '060411239',
    '818215782'
];

$charity_twitter_seed = [
    'RedCross',
    'AmericanCancer',
    'safoodbank',
    'wwpinc',
    'Silver_BlackCR',
    'su2c',
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
    'StJude',
    'giftcardgiver',
    'TOMSshoes',
    'USFWSPacific',
    'IUCN',
    'RnfrstAlliance',
    'ReeveFoundation',
    'TheVFoundation',
    'AHASanAntonio',
    'FisherHouseWH',
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
        for ($i=1;$i<=46;$i++ ) 
        {
            $charity = new Charity();
            $charity->user_id = $i;
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

    }
}

class TransactionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('transactions')->delete();

        
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
        // $period = ['April 2014', 'May 2014', 'June 2014', 'July 2014'];
        // $tweet_count = [100, 150, 275, 345];
        // $is_paid = [1,1,1,0];

        // for ($a=1;$a<=5;$a++) 
        // {
        //     $activity = new Activity();
        //     $activity->donor_id = 1;
        //     $activity->period = $period[$a];
        //     $activity->tweet_count = $tweet_count[$a];
        //     $activity->is_paid = $is_paid[$a];
        //     $activity->save();
        // }

    }


}

