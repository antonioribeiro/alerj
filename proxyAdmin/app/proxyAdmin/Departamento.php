<?php

class Departamento extends BaseModel {

	protected $primaryKey = 'codigo_departamento';
	protected $connection = 'adm_user';
	protected $table = 'departamento';

	public function getNomeDepartamentoAttribute($nome_departamento)
	{
		return utf8_encode($nome_departamento);
	}

	public function usuarios()
	{
		$this->hasMany('Usuario', 'codigo_usuario');
	}

	public function getList($parent, $child)
	{
		if($child === 'all')
		{
			return Departamento::where('codigo_departamento', $parent)->get()->toArray();
		}

		if( ! $parent)
		{
			$departamentos = Departamento::all()->toArray();
		}
		else
		{
			$departamentos = Departamento::where('departamento_superior_id', $child)->get()->toArray();
			if(count($departamentos) == 0)
			{
				$departamentos = Departamento::where('codigo_departamento', $child)->get()->toArray();
			}
		}

		if(count($departamentos) > 1)
		{
			array_unshift($departamentos, ['codigo_departamento' => 'all', 'nome_departamento' => 'TODOS', 'sigla_departamento' => '']);
		}

		return $departamentos;
	}

	public function findChildOrParent($parent, $child)	
	{
		if($child)
		{
			$departamento = Departamento::find($child);
		}
		else if($parent)
		{
			$departamento = Departamento::find($parent);
		}
		else
		{
			$departamento = null;
		}
	
		return $departamento;		
	}

	public static function findByAnything($id)
	{
		if($id === 'all')
		{
			$d = new Departamento;
			$d->codigo_departamento = 'all';
			$d->nome_departamento = 'TODOS';
			$d->sigla_departamento = 'TODOS';
		}
		else
		{
			$d = Departamento::find($id);
		}

		return $d;
	}

	public function getAll()
	{
		DB::connection('adm_user')->statement("IF OBJECT_ID('tempdb..#tmp', 'U') IS NOT NULL DROP TABLE #tmp;");

		DB::connection('adm_user')->statement("CREATE TABLE #tmp (codigo_departamento int, sigla_departamento varchar(20), nome_departamento varchar(255), nivel int);");

		DB::connection('adm_user')->statement("INSERT INTO  #tmp (codigo_departamento, sigla_departamento, nome_departamento, nivel) EXEC dbo.hierarquia_departamental 1;");

		return DB::connection('adm_user')->table("#tmp")->get();
	}
}
