<?php

class HomeController extends BaseController {

	public function index()
	{
		return View::make('site.home.index')
				->with('departamentos', Departamento::all());
	}

}