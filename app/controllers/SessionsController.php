<?php

class SessionsController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('guest', array('except' => 'destroy'));
  }

	/**
	 * Show the form for creating a new resource.
	 * GET /sessions/create
	 *
	 * @return Response
	 */
	public function create()
	{
    return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sessions
	 *
	 * @return Response
	 */
	public function store()
	{
    $rules = array(
      'username' => 'required',
      'password' => 'required'
    );

    $validator = Validator::make(Input::all(), $rules);

    // Validation fail redirect
    if ($validator->fails())
    {
        return Redirect::back()->withInput()->withErrors($validator);
    }

    // Attemp to authenticate
    if (!Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
      Flash::error('Wrong Username or Password');
      return Redirect::back()->withInput();
    }

    return Redirect::intended('tasks');

	}


	/**
	 * Remove the specified resource from storage.
	 * DELETE /sessions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
    Auth::logout();
    return Redirect::to('sign-in');
	}

}
