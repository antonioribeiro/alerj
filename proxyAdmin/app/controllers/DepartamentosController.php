<?php

class DepartamentosController extends BaseController {

	public function __construct(Departamento $departamento)
	{
		$this->departamento = $departamento;
	}

	public function index($parent = null, $child = null)
	{

		if ($parent == null and $child == null)
		{
			$departamento = Usuario::find( Auth::user()->codigo_usuario )->departamento;

			if($departamento->sigla_departamento !== 'DGIPD')
			{
				$parent = $departamento->codigo_departamento;
				$child = 'all';
			}

		}

		return $this->index2($parent, $child);

	}

	public function index2($parent = null, $child = null)
	{
		if($parent === 'all' and $child === 'all')
		{
			return Redirect::route('proxy', ['all','all']);
		}

		$departamentos = $this->departamento->getList($parent, $child);

		if(count($departamentos) > 0 and $child)
		{	
			return Redirect::route('usuarios', $child);
		}

		$departamento = $this->departamento->findChildOrParent($parent, $child);

		if($departamento)
		{
			$parent = $departamento->codigo_departamento;
		}
		else
		{
			$parent = 'all';
		}

		return View::make('site.departamentos.index')
				->with('parent', $parent ?: 'all')
				->with('departamento', $departamento)
				->with('departamentos', $departamentos);	
	}

}