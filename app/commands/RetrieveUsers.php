<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RetrieveUsers extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'RetrieveUsers';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Retrieves active donors from Users table.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$recordsUpdated = 0;
		$userStatusUpdated = 0;
		$tweetCount = 0;

		//retrieve all active donors from database
		$users = User::where('is_active','1')->where('role_id','3')->get();
		//enumerate through users to retrieve twitter profile updates and tweet count
		foreach ($users as $user)
		{
			//to-do:  need to verify this is the proper process for retrieving data from Twitter using 

		    // Setup OAuth token and secret
		    PhiloTwitter::setOAuthToken($user->oauth_token);
		    PhiloTwitter::setOAuthTokenSecret($user->oauth_token_secret);
			//retrieve tweets from User's Timeline
		    $tweets = Twitter::statusesUserTimeline($user->user_id);

			//retrieve previous activity
			$tweetCount = Activity::where('donor_id',$user->donor->donor_id)->sum('tweet_count');

		    Log::info($user->twitter_handle);
		    // Log::info($tweets);
		    Log::info($tweets[0]['user']['statuses_count']);

			// //if user not found; ie. account cancelled (change role to '2') then set 'is_active' to false and move on
			// if($tweets['error'])  //to-do:  what error will we get back (i.e. how do I trap it)?
			// {
			// 	$userStatusUpdated++;
			// }
			// else
			// {			
			// 	//create  a new instance activity
				$activity = new Activity();

				//write values
				$activity->donor_id = $user->donor->id;
				$tweetCount=$tweets[0]['user']['statuses_count']-$tweetCount;
				$activity->tweet_count = $tweetCount;
				$activity->save();
				$recordsUpdated++;
				
			// }

		}

		$this->info($recordsUpdated . ' users updated.');
		$this->info($userStatusUpdated . ' users made inactive.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::OPTIONAL, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
