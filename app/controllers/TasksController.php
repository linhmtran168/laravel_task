<?php

class TasksController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('auth');
  }

	/**
	 * Display a listing of the resource.
	 * GET /tasks
	 *
	 * @return Response
	 */
	public function index()
	{
    $tasks = Task::paginate(5);
    return View::make('tasks.index')->with('tasks', $tasks);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tasks/create
	 *
	 * @return Response
	 */
	public function create()
	{
    return View::make('tasks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tasks
	 *
	 * @return Response
	 */
	public function store()
	{
    $rules = array(
      'name' => 'required|min:6',
      'importance' => 'in:red,yellow,green',
      'status' => 'in:opened,in_progress,finished'
    );

    // Try to validate
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return Redirect::back()->withInput()->withErrors($validator);
    }

    $task = new Task(Input::all());
    Auth::user()->tasks()->save($task);

    Flash::success('Create task successfully');
    return Redirect::to('tasks');
	}


	/**
	 * Show the form for editing the specified resource.
	 * GET /tasks/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
    $task = Task::find($id);
    return View::make('tasks.edit')->with('task', $task);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tasks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
    $rules = array(
      'name' => 'required|min:6',
      'importance' => 'in:red,yellow,green',
      'status' => 'in:opened,in_progress,finished'
    );

    // Try to validate
    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return Redirect::back()->withInput()->withErrors($validator);
    }

    $task = Task::find($id);
    $task->name = Input::get('name');
    $task->description = Input::get('description');
    $task->status = Input::get('status');
    $task->importance = Input::get('importance');
    $task->save();

    Flash::success('Update Task Success');
    return Redirect::to('tasks');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tasks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
    $task = Task::find($id);
    $task->delete();
    Flash::success('Delete task successfully');
    return Redirect::to('tasks');
	}

}
