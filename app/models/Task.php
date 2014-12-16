<?php

class Task extends \Eloquent {

  protected $table = 'tasks';
	protected $fillable = ['name', 'description', 'importance', 'status'];

  public function user()
  {
    return $this->belongsTo('User');
  }
}
