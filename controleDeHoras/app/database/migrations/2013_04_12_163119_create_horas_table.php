<?php

use Illuminate\Database\Migrations\Migration;

class CreateHorasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('horas', function($table) {
			$table->increments('id');
			$table->integer('funcionario_id');
			$table->timestamp('hora_entrada')->index();
			$table->timestamp('hora_saida')->nullable()->index();
			$table->integer('funcionario_informou_id');
			$table->string('descricao')->nullable();
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
		Schema::drop('horas');
	}

}