<?php

class Hora extends BaseModel {

	protected $table = 'horas';

	protected $guarded = [];

	public $rules = [];

	public static function toggle($id)
	{
		$funcionario = Funcionario::find($id);

		if ( ! $funcionario->isLoggedIn() )
		{
			$funcionario->logIn();
		}
		else
		{
			$funcionario->logOut();
		}
	}

}