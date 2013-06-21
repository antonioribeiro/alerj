<?php

use Carbon\Carbon;

class Funcionario extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'funcionarios';

	protected $guarded = [];

	public $rules = [];

	static public function searchByUsername($userName) {
		
		if (substr($userName, 0, 1) == 'u' and is_numeric(substr($userName, 1))) {
			$ret = Funcionario::where('matricula', substr($userName, 1, 6).'-'.substr($userName, 7, 1))->first();
		} else {
			$ret = Funcionario::where('usuario',$userName)->first();
		}

		if(!$ret) {
			$ret = Funcionario::where('nome',$userName)->first();
		}

		return $ret;

	}

	static public function getLoggedUserFullName() {

		$funcionario = Funcionario::searchByUsername(Auth::user()->username);

		if(isset($funcionario)) {
			return "$funcionario->nome ($funcionario->matricula)";
		}

		return "$funcionario (usuário não encontrado)";

	}

	static public function isAdministrator()
	{
		$funcionario = Funcionario::searchByUsername(Auth::user()->username);

		return $funcionario->id == 1 or $funcionario->administrador;
	}

	static public function getLoggedUserId() {

		$funcionario = Funcionario::searchByUsername(Auth::user()->username);

		if(isset($funcionario)) {
			return $funcionario->id;
		}

		return null;

	}

	public function isLoggedIn() {

		$horas = Hora::where('funcionario_id', $this->id)->whereNull('hora_saida')->get();

		$today = (new DateTime)->setTime(0,0,0);

		foreach($horas as $hora) {
			$horaEntrada = (new DateTime($hora->hora_entrada))->setTime(0,0,0);
			if ($horaEntrada < $today) {
				$h = explode(':', $this->horario_limite);
				$hora->hora_saida = $horaEntrada->setTime($h[0],$h[1],0);
				$hora->save();
			} else {
				return true;
			}
		}

		return false;

	}

	public function ramais() {
		
		$ramais = $this->ramal;

		if(isset($this->ramal_movel)) {
			$ramais = $ramais . (!empty($ramais) ? ' e ' : '') . "$this->ramal_movel (móvel)";
		}

		return $ramais;
	}

	public static function authenticate($username, $password)
	{
		if( Funcionario::tryAuthenticate($username, $password) ) return true;

		$funcionario = Funcionario::searchByUsername($username);

		if( Funcionario::tryAuthenticate($funcionario->usuario, $password) ) return true;
		if( Funcionario::tryAuthenticate($funcionario->nome, $password) ) return true;

		return false;
	}

	public static function tryAuthenticate($username, $password)
	{

		$ldaprdn = "CN=$username,OU=SDGI,OU=Departamentos,OU=ALERJ,DC=alerj,DC=gov,DC=br";

		Log::error($ldaprdn);

		$ldapconn = ldap_connect("alv107.alerj.gov.br") or die("Could not connect to LDAP server.");
		$result = false;

		if ($ldapconn) 
		{

			$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $password);

			if ($ldapbind) 
			{
				$result = true;
			} else {
				Log::error('Error binding to LDAP.');
			}

			ldap_unbind($ldapconn);

		} else {
			Log::error('Error connecting to LDAP.');
		}

		return $result;

	}

	public static function workHours($funcionario, $dateStart, $dateEnd) 
	{
		if($dateStart > Carbon::today()) return null;

		if( ! $funcionario instanceof Funcionario)
		{
			$funcionario = Funcionario::find($funcionario);
		}

		$horas = Hora::where('funcionario_id', $funcionario->id)->where('hora_entrada','>=',$dateStart)->where('hora_entrada','<=',$dateEnd)->orderBy('id')->get();

		$seconds = 0;
		foreach($horas as $hora) {
			$saida = $hora->hora_saida ?: Carbon::now()->toDateTimeString();
			$seconds += Tools::diffInSeconds($hora->hora_entrada, $saida);
		}

		return Tools::seconds2humanHours($seconds);
	}

	public function getArticleDateAttribute()
	{
		return "1";
	}

	public function getArticleUserAttribute()
	{
		return "2";
	}
}