<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->increments('id');
      $table->integer('user_id');
      $table->string('name');
      $table->text('description')->nullable();
      $table->enum('importance', array('red', 'yellow', 'green'));
      $table->enum('status', array('in_progress', 'finished', 'opened'));
      $table->foreign('user_id')
      ->references('id')->on('users')
      ->onDelete('cascade');

			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tasks');
	}

}
