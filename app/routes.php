<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
  return Redirect::to('tasks');
});

Route::get('/sign-in', array(
  'as' => 'sign_in_path',
  'uses' => 'SessionsController@create'
));

Route::post('/sign-in', array(
  'as' => 'sign_in_path',
  'uses' => 'SessionsController@store'
));

Route::get('/sign-out', array(
  'as' => 'sign_out_path',
  'uses' => 'SessionsController@destroy'
));

Route::get('/register', array(
  'as' => 'register_path',
  'uses' => 'RegistrationsController@create'
));

Route::post('/register', array(
  'as' => 'register_path',
  'uses' => 'RegistrationsController@store'
));

Route::get('/tasks', array(
  'as' => 'list_tasks_path',
  'uses' => 'TasksController@index'
));

Route::get('/tasks/create', array(
  'as' => 'create_task_path',
  'uses' => 'TasksController@create'
));

Route::post('/tasks/create', array(
  'as' => 'create_task_path',
  'uses' => 'TasksController@store'
));

Route::post('/tasks/delete/{id}', array(
  'as' => 'delete_task_path',
  'uses' => 'TasksController@destroy'
));

Route::get('/tasks/edit/{id}', array(
  'as' => 'edit_task_path',
  'uses' => 'TasksController@edit'
));

Route::put('/tasks/edit/{id}', array(
  'as' => 'edit_task_path',
  'uses' => 'TasksController@update'
));
