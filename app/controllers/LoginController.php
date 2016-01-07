<?php

class LoginController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$userdata = array(
			'name' => \Input::get('name'),
			'password' => \Input::get('password')
		);
	    if (\Auth::attempt($userdata,true)){

	    	Session::put('name', $userdata['name']);
	    	
	    	return \Redirect::intended('/messages');
	    } else {

	    	Session::put('response', 'Sorry, that name and password was incorrect');

	        return \Redirect::back()->with('message', 'Login credentials were incorrect');
	    }



	}

	public function getLogout()
	{
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
