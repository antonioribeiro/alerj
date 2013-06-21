<?php

class FuncionariosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$funcionario = Funcionario::find($id);

		return View::make('funcionarios.edit')
				->with('funcionario', $funcionario);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$funcionario = Funcionario::find($id);

		$funcionario->update(Input::all());

		Session::flash('message', 'Funcionario gravado');

		return Redirect::route('funcionarios.frequency',$funcionario->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function logout() {
		Auth::logout();
		Session::regenerate();
		return Redirect::to('/');
	}

	public function frequency($id) {
		$funcionario = 	Funcionario::find($id);
		$funcionario->isLoggedIn(); /// just check to log user off
		
		$horas = Hora::where('funcionario_id', $id)
					->orderBy('id', 'desc')
					->get();

		return View::make('funcionarios.frequency')
				->with('funcionario',$funcionario)
				->with('horas',$horas);
	}


}