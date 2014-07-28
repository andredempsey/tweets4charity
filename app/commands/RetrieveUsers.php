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
		$recordsCreated = 0;

		//retrieve all active donors from database
		$users = User::where('is_active','1')->where('role_id','3')->get();
		$charities = User::where('is_active','1')->where('role_id','4')->get();
		
		//update profile pictures for active charities
		foreach ($charities as $charity) 
		{
			if ($charity->user_id != null) 
			{
				$profile = Twitter::usersLookup($user->user_id);
				$charity->user->profile_picture_link = $profile[0]['profile_image_url'];
			}
		}
		//enumerate through users to retrieve twitter profile updates and tweet count
		foreach ($users as $user)
		{
			//retrieve tweets from User's Timeline and update profile image
		    $tweets = Twitter::usersLookup($user->user_id);
			$user->profile_picture_link = $tweets[0]['profile_image_url'];
			$user->save();
			
			//check if entry exists in activites table for donor in the current month
			$activity = Activity::where('donor_id', '=',$user->donor->id)->where('period', '=', date("F Y", strtotime(date('F Y'))))->first();

			if (is_null($activity)) 
			{
			//no
			//add new record
			//create  a new instance activity
				$activity = new Activity();
				$activity->donor_id = $user->donor->id;
				$tweetCount=$tweets[0]['statuses_count'];
				$activity->period = date("F Y",strtotime(date('F Y')));
				$activity->is_paid = False;
				$activity->tweet_count = $tweetCount;
				$activity->save();
				$recordsCreated++;
			} 
			else 
			//overwrite tweet count in existing record
			{
				$tweetCount=$tweets[0]['statuses_count'];
				$activity->tweet_count = $tweetCount;
				$activity->save();
				$recordsUpdated++;
			}
		}

		$this->info($recordsCreated . ' activity entries created.');
		$this->info($recordsUpdated . ' activity entries updated.');
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
