<?php
class UsersController extends BaseController {


public function __construct()
	{
    	// call base controller constructor
    	parent::__construct();

    	// run auth filter before all methods on this controller except index and show
    	$this->beforeFilter('auth', array('except' => array('index', 'show', 'destroy')));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		
		return View::make('tweetsforcharity.public_profile');
	}


	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tweetsforcharity.user_sign_up');

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$messageValue = 'Successfully registered!';
		$eMessageValue = 'There was a problem registering.';
		$user = new User();
		$id = 0;
		$validator = Validator::make(Input::all(), User::$user_rules);
		if ($validator->fails()) 
		{
			Session::flash('errorMessage', $eMessageValue);
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else
		{
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->twitter_handle = Input::get('twitter_handle');
			$user->password = Hash::make(Input::get('password'));
			$user->is_admin = False;
			$user->is_active = True;
			$user->save();		
			$i = DB::getPdo()->lastInsertId();
			Session::flash('successMessage', $messageValue);
			return Redirect::action('UsersController@show', $user->twitter_handle);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  $twitter_handle
	 * @return Response
	 */
	public function show($twitter_handle)
	{
		$user = User::findByTwitterHandle($twitter_handle);
		return View::make('tweetsforcharity.public_profile')->with('user', $user);;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($twitter_handle)
	{

		$user = User::findByTwitterHandle($twitter_handle);
		return View::make('tweetsforcharity.user_dashboard')->with('user', $user);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($twitter_handle)
	{
		if (!isset($twitter_handle)) 
		{
			$user = new User();
			$user->twitter_handle = Auth::user()->twitter_handle;

			$messageValue = 'Successfully registered!';
			$eMessageValue = 'There was a problem registering.';
		} 
		else 
		{
			$user = User::findByTwitterHandle($twitter_handle);

			$messageValue = 'User information was successfully updated!';
			$eMessageValue = 'There was a problem updating your user information.';
		}

		// if(!(Auth::check() && (Auth::user()->id == $user->twitter_handle || Auth::user()->is_admin)))
		// {
		// 	Session::flash('errorMessage', 'Insufficient privileges.');
		// 	return Redirect::action('UsersController@edit', $user->twitter_handle);
		// }

		$validator = Validator::make(Input::all(), User::$user_update_rules);


		if ($validator->fails()) 
		{

			Session::flash('errorMessage', $eMessageValue);
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else
		{
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->amount_per_tweet = Input::get('amount_per_tweet');
			$user->report_frequency = Input::get('report_frequency');
			$user->monthly_goal = Input::get('monthly_goal');
			$user->save();	

			if(Input::hasFile('image') && Input::file('image')->isValid())
			{
				$user->addUploadedImage(Input::file('image'));
				$user->save();
			}

			Session::flash('successMessage', $messageValue);
			return Redirect::action('UsersController@show', $user->twitter_handle);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return make::View('users.destroy');
	}
}

