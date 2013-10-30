<?php

use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionarios', function($table) {
			$table->increments('id');
			$table->string('matricula');
			$table->string('nome');
			$table->string('divisao');
			$table->string('usuario');
			$table->string('email');
			$table->string('ramal')->nullable();
			$table->string('ramal_movel')->nullable();
			$table->string('residencia')->nullable();
			$table->string('celular')->nullable();
			$table->string('horario_limite')->default('19:00:00');
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
		Schema::drop('funcionarios');
	}

}
