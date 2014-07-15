<?php
class UsersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('tweetsforcharity.landingpage');
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
			$user->first_name = Input::get('firstname');
			$user->last_name = Input::get('lastname');
			$user->email = Input::get('email');
			$user->twitter_handle = Input::get('twitterhandle');
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
	public function show($id)
	{
		$users = User::with('selectedcharity')->with('charity')->get();
		$number = Post::countPosts($searchTitle);
		$data = [
			'posts' => $posts,
			'number'  => $number,
			'isFiltered' => $isFiltered,
			// 'recentposts' => $recentposts
		];
	    return View::make('posts.index')->with($data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

