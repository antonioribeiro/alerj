<?php

use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dbo.permissions', function($table) {
			$table->increments('id');
			$table->integer('department_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->integer('list_id');
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
		Schema::drop('dbo.permissions');
	}

}