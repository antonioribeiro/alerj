<?php

use Illuminate\Database\Migrations\Migration;

class AddAdministratorField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funcionarios', function($table) {
			$table->boolean('administrador')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('funcionarios', function($table) {
			$table->dropColumn('administrador');
		});
	}

}