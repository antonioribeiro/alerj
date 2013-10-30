<?php

class Permission extends Eloquent {

	protected $primaryKey = 'urls';
	protected $connection = 'sdgipa';
	protected $table = 'permissions';

	protected $fillable = [
							'department_id', 
							'user_id', 
							'list_id', 
						];

	public static function updateList($departamento, $usuario, $groups)
	{
		$departamento = Departamento::findByAnything($departamento);
		$usuario = Usuario::findByAnything($usuario);

		$permissions = Permission::whereNotNull('id');

		if($departamento->codigo_departamento === 'all')
		{
			$permissions->whereNull('department_id');
			$dId = null;
		}
		else
		{
			$permissions->where('department_id', $departamento->codigo_departamento);
			$dId = $departamento->codigo_departamento;
		}

		if($usuario->codigo_usuario === 'all')
		{
			$permissions->whereNull('user_id');
			$uId = null;
		}
		else
		{
			$permissions->where('user_id', $usuario->codigo_usuario);
			$uId = $usuario->codigo_usuario;
		}

		$permissions->delete();

		foreach($groups as $group)
		{
			Permission::create([
									'department_id' => $dId,
									'user_id' => $uId,
									'list_id' => $group,
								]);
		}
	}

	public static function getSelected($departamento, $usuario)
	{
		$departamento = $departamento == 'all' ? null : $departamento;
		$usuario = $usuario == 'all' ? null : $usuario;

		$items = Permission::select('list_id')
						->where('department_id', $departamento)
						->where('user_id', $usuario)->get();

		$r = [];
		
		foreach($items as $item)
		{
			$r[] = $item->list_id;
		}

		return $r;
	}

}
