<?php

class FuncionariosTableSeeder extends Seeder {

	public function run()
	{

		$funcionarios = array(
			array('matricula' => '201775-4', 'nome' => 'Ricardo Luiz Schneider', 'divisao' => 'DITI', 'usuario' => 'rschneid', 'email' => 'rschneid@alerj.rj.gov.br', 'ramal' => '8461', 'ramal_movel' => '4571', 'residencia' => '2557-5961', 'celular' => '8816-5961', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('matricula' => '201794-5', 'nome' => 'Antonio Carlos Ribeiro Faria', 'divisao' => 'DITI', 'usuario' => 'afaria', 'email' => 'afaria@alerj.rj.gov.br', 'ramal' => '8469', 'ramal_movel' => null, 'residencia' => '2556-3164', 'celular' => '8088-2233', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('matricula' => '201799-4', 'nome' => 'José Carlos Chiappini', 'divisao' => 'DITI', 'usuario' => 'jchiappi', 'email' => 'jchiappi@alerj.rj.gov.br', 'ramal' => '8467', 'ramal_movel' => null, 'residencia' => '2629-7950', 'celular' => '9879-1168', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('matricula' => '201774-7', 'nome' => 'Mauro Guimarães', 'divisao' => 'DITI', 'usuario' => 'mguimara', 'email' => 'mguimara@alerj.rj.gov.br', 'ramal' => '8468', 'ramal_movel' => null, 'residencia' => '2287-4078', 'celular' => '8157-5459', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('matricula' => '201798-6', 'nome' => 'Aurélio Scheidegger Stauffer', 'divisao' => 'DITI', 'usuario' => 'astauffe', 'email' => 'astauffe@alerj.rj.gov.br', 'ramal' => '8469', 'ramal_movel' => null, 'residencia' => '2135-8608', 'celular' => '9163-8608', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('matricula' => '200827-4', 'nome' => 'Carlos Eduardo Lopes Soares', 'divisao' => 'DITI', 'usuario' => 'csoares', 'email' => 'cesoares@alerj.rj.gov.br', 'ramal' => '8468', 'ramal_movel' => null, 'residencia' => '2612-5558', 'celular' => '7250-4680', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('matricula' => '201757-2', 'nome' => 'Adauri Cardoso de Azevedo', 'divisao' => 'DITI', 'usuario' => 'aazevedo', 'email' => 'aazevedo@alerj.rj.gov.br', 'ramal' => '8467', 'ramal_movel' => null, 'residencia' => '2463-0136', 'celular' => '9941-0480', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'updated_at' => new DateTime),
			array('matricula' => '201201-2', 'nome' => 'Carla Aguilar Falcão', 'divisao' => 'DITI', 'usuario' => 'cfalcao', 'email' => 'cfalcao@alerj.rj.gov.br', 'ramal' => '8088', 'ramal_movel' => NULL, 'residencia' => '2425-4227', 'celular' => '7832-5395', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'update_at' => new DateTime),
			array('matricula' => '201201-2', 'nome' => 'Gustavo A. de S. Carvalho', 'divisao' => 'DITI', 'usuario' => 'gadolpho', 'email' => 'gadolpho@alerj.rj.gov.br', 'ramal' => '8088', 'ramal_movel' => NULL, 'residencia' => '2261-1012', 'celular' => '9811-9822', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'update_at' => new DateTime),
			array('matricula' => '201201-2', 'nome' => 'Luiz Guilherme D. de Oliveira', 'divisao' => 'DITI', 'usuario' => 'lgoliveira', 'email' => 'lgoliveira@alerj.rj.gov.br', 'ramal' => '8088', 'ramal_movel' => NULL, 'residencia' => null, 'celular' => '9128-3813', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'update_at' => new DateTime),
			array('matricula' => '201201-2', 'nome' => 'Marcelo Lyra Bastos', 'divisao' => 'DITI', 'usuario' => 'mbastos', 'email' => 'mbastos@alerj.rj.gov.br', 'ramal' => '8088', 'ramal_movel' => NULL, 'residencia' => '2526-0634', 'celular' => '8855-0500', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'update_at' => new DateTime),
			array('matricula' => '201201-2', 'nome' => 'Luiz Carlos Gouvea', 'divisao' => 'DITI', 'usuario' => 'lgouvea', 'email' => 'lgouvea@alerj.rj.gov.br', 'ramal' => '8088', 'ramal_movel' => NULL, 'residencia' => null, 'celular' => null, 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'update_at' => new DateTime),
			array('matricula' => '201201-2', 'nome' => 'Ricardo Souza Oliveira', 'divisao' => 'DITI', 'usuario' => 'rsoliveir', 'email' => 'rsoliveir@alerj.rj.gov.br', 'ramal' => '8088', 'ramal_movel' => NULL, 'residencia' => '2596-4816', 'celular' => '9664-9500', 'horario_limite' => '19:00:00', 'created_at' => new DateTime, 'update_at' => new DateTime),
		);

		DB::table('funcionarios')->insert($funcionarios);
	}

}
