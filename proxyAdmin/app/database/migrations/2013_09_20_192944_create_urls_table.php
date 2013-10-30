<?php

use Illuminate\Database\Migrations\Migration;

class CreateUrlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dbo.urls', function($table) {
			$table->increments('id');
			$table->integer('list_id');
			$table->string('url');
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
		Schema::drop('dbo.urls');
	}

}