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

		//retrieve all active donors from database
		$users = User::where('is_active','1')->where('role_id','3')->get();
		//enumerate through users to retrieve twitter profile updates and tweet count
		foreach ($users as $user)
		{
			//to-do:  need to verify this is the proper process for retrieving data from Twitter using 

			//retrieve tweets from User's Timeline
		    $tweets = Twitter::statusesUserTimeline($user->user_id);
		    // Log::info($tweets[0]['user']['statuses_count']);
			 // Log::info($tweets);
		    //to-do:  save latest profile picture to database
		    //to-do:  refactor so this happens when user logs in
			$user->profile_picture_link = $tweets[0]['user']['profile_image_url'];
			$user->save();
			// 	//create  a new instance activity
				$activity = new Activity();

				//write values
				$activity->donor_id = $user->donor->id;
				$tweetCount=$tweets[0]['user']['statuses_count'];
				$activity->tweet_count = $tweetCount;
				$activity->save();
				$recordsUpdated++;
				
			// }

		}

		$this->info($recordsUpdated . ' activity entries created.');
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
