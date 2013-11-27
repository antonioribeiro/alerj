<?php

class Usuario extends BaseModel {

	protected $primaryKey = 'codigo_usuario';
	protected $connection = 'adm_user';
	protected $table = 'usuario';

	public function getNomeUsuarioAttribute($nome_usuario)
	{
		return utf8_encode($nome_usuario);
	}

	public function getList($departamento)
	{
		$usuarios = Usuario::where('codigo_departamento', $departamento)->where('status_usuario', 'A')->orderBy('nome_usuario')->get()->toArray();

		array_unshift($usuarios, ['codigo_usuario' => 'all', 'nome_usuario' => 'TODOS', 'nome_windows_usuario' => 'TODOS']);

		return $usuarios;
	}

	public function departamento()
	{
		return $this->belongsTo('Departamento', 'codigo_departamento');
	}

	public static function findByAnything($id)
	{
		if($id === 'all')
		{
			$u = new Usuario;
			$u->codigo_usuario = 'all';
			$u->nome_usuario = 'TODOS';
			$u->nome_windows_usuario = 'TODOS';
		}
		else
		{
			$u = Usuario::find($id);
		}

		return $u;
	}
	
}
