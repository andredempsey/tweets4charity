<?php
class UsersController extends BaseController {

public function __construct()
	{
    	// call base controller constructor
    	parent::__construct();

    	// run auth filter before all methods on this controller except index and show
    	$this->beforeFilter('auth', array('except' => array('index', 'show', 'destroy')));
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		
		return View::make('tweetsforcharity.user_dashboard');
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
			Session::flash('successMessage', $messageValue);
			return Redirect::action('UsersController@index');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($twitter_handle)
	{
		$user = User::find($twitter_handle);
		$charities = Charity::all();
		$data = array(
			'user' => $user,
			'charities' => $charities,
		);
		return View::make('tweetsforcharity.public_profile')->with($data);

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($twitter_handle)
	{
		$user = User::find($twitter_handle);
		return View::make('tweetsforcharity.user_dashboard')->with('user', $user);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return make::View('users.update');
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

