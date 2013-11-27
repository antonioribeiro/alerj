<?php

class UsuariosController extends BaseController {

	public function __construct(Usuario $usuario)
	{
		$this->usuario = $usuario;
	}

	public function index($id)
	{
		$departamento = Departamento::find($id);
		$usuarios = $this->usuario->getList($departamento->codigo_departamento);

		if(count($usuarios) === 1)
		{
			return Redirect::route('proxy', [$departamento->codigo_departamento, $usuarios[0]['codigo_usuario']]);
		}

		return View::make('site.usuarios.index')
				->with('departamento', $departamento)
				->with('usuarios', $usuarios);
	}

}