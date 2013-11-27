<?php

class Permission extends BaseModel {
	protected $userTtl = 0; /// user query lasts for x minutes

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

		if($groups)
		{
			foreach($groups as $group)
			{
				Permission::create([
										'department_id' => $dId,
										'user_id' => $uId,
										'list_id' => $group,
									]);
			}
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

	public static function hasAccess($user, $url)
	{
		$result = true; /// or DENY

		$url = BlockingUrl::where('url', $url)->remember(100)->first();

		$user = Usuario::where('nome_windows_usuario', strtoupper($user))->remember(100)->first();

		if ($url && $user)
		{
			$result = Permission::where('list_id', $url->list_id)
						->where(function($query) use ($user)
						{
							$query->where('user_id', $user->codigo_usuario)
									->orWhere(function($query) use ($user)
									{
										$query->where('department_id', $user->codigo_departamento)
											  ->whereNull('user_id');
									});
						})
						->remember(1)->first();

		}

		return $result;
	}

}
