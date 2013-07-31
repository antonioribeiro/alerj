<?php

use Illuminate\Database\Migrations\Migration;

class AddSaidaAutomaticaToFuncionarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('horas', function($table) {
			$table->boolean('saida_automatica')->default(false);
			$table->timestamp('alterado_em')->nullable();
			$table->integer('alterado_por')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('horas', function($table) {
			$table->dropColumn('saida_automatica');
			$table->dropColumn('alterado_em');
			$table->dropColumn('alterado_por');
		});
	}

}