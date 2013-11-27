<?php

class ProxyController extends BaseController {

	public function show($departamento, $usuario)
	{
		$selected = Permission::getSelected($departamento, $usuario);

		$departamento = Departamento::findByAnything($departamento);
		$usuario = Usuario::findByAnything($usuario);
		$lists = BlockingList::all();

		return View::make('site.proxy.edit')
				->with('departamento', $departamento)
				->with('usuario', $usuario)
				->with('lists', $lists)
				->with('selected', $selected);
	}

	public function edit($departamento, $usuario)
	{
		Permission::updateList($departamento, $usuario, Input::get('group'));

		return Redirect::back()->with('message', 'As permissões foram atualizadas.');
	}

	public function check($user, $url)
	{
		return Permission::hasAccess($user, $url) ? "ALLOW" : "DENY";
	}

}