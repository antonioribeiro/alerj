<?php

class HorasController extends BaseController {

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
		$model = Hora::find($id);
		$funcionario = Funcionario::find($model->funcionario_id);

		return View::make('horas.edit')
				->with('hora', $model)
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
		$model = Hora::find($id);

		$horas = Hora::where('funcionario_id',$model->funcionario_id)->where('id', '<>', $id)->orderBy('id','desc')->first();

		$input = Input::all();

		if (isset($input['h_entrada']) and $input['h_entrada']) {
			$time = new ExpressiveDate($model->hora_entrada);
			$t = explode(':',$input['h_entrada']);
			$time->setTime($t[0],$t[1],0);
			$time->setDefaultDateFormat('Y.m.d H:i');
			$input['hora_entrada'] = "$time";
		} else {
			Abort::error(404);
		}

		if (isset($input['h_saida']) and $input['h_saida']) {
			$time = new ExpressiveDate($model->hora_entrada);
			$t = explode(':',$input['h_saida']);
			$time->setTime($t[0],$t[1],0);
			$time->setDefaultDateFormat('Y.m.d H:i');
			$input['hora_saida'] = "$time";
		} else {
			$input['hora_saida'] = null;
		}

		if ( ! isset($input['hora_saida'])) {
			$input['hora_saida'] = null;
		} else {
			if ($horas and ($input['hora_saida'] < $model->hora_saida))
			{
				Session::flash('error', 'Horario de saída digitado não pode ser anterior a '.Tools::time($model->hora_saida));
				return $this->edit($id);
			}
		}

		if ($input['hora_saida'] and ($input['hora_saida'] < $model->hora_entrada))
		{
			Session::flash('error', 'Horario de saída digitado não pode ser anterior ao horário de entrada ('.Tools::time($model->hora_entrada).').');
			return $this->edit($id);
		}

		if ( ! isset($input['descricao']) or empty($input['descricao']) )
		{
			Session::flash('error', 'O motivo/descrição precisa ser preenchido.');
			return $this->edit($id);
		}

		$time = new ExpressiveDate;
		$time->setDefaultDateFormat('Y.m.d H:i');
		$input['alterado_em'] = "$time";
		$input['alterado_por'] = Auth::user()->id;

		$model->update($input);

		Session::flash('message', 'Frequencia alterada');

		return Redirect::route('funcionarios.frequency',$model->funcionario_id);
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

	public function toggle($id)
	{
		Hora::toggle($id);

		return Redirect::to('/');
	}

}

