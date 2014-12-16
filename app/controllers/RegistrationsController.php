<?php

class RegistrationsController extends \BaseController {

  function __construct()
  {
    $this->beforeFilter('guest');
  }

	/**
	 * Show the form for creating a new resource.
	 * GET /registrations/create
	 *
	 * @return Response
	 */
	public function create()
	{
    return View::make('registrations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /registrations
	 *
	 * @return Response
	 */
	public function store()
	{
    $rules = array(
      'username' => 'required|min:6|unique:users',
      'password' => 'required|min:6|confirmed'
    );

    // Try to validate
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return Redirect::back()->withInput()->withErrors($validator);
    }

    // Create new User and redirect to sign in
    $user = new User;
    $user->username = Input::get('username');
    $user->password = Input::get('password');
    $user->save();
    Flash::success('Register Success');
    return Redirect::to('sign-in');
	}


}
