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

	public function horasTem($userName) {

		return $this->hasMany('Hora');
		
	}

	public function horas()
	{
		return $this->hasMany('Hora', 'funcionario_id');
	}

	static public function searchByUsername($userName) {
		
		$ret = false;

		if (substr($userName, 0, 1) == 'u' and is_numeric(substr($userName, 1))) {
			$ret = Funcionario::where('matricula', substr($userName, 1, 6).'-'.substr($userName, 7, 1))->first();
		}

		if ( !$ret) {
			$ret = Funcionario::where('usuario',$userName)->first();
		}

		if ( !$ret) {
			$ret = Funcionario::where('usuario',strtolower($userName))->first();
		}

		if ( !$ret) {
			$ret = Funcionario::where('nome',$userName)->first();
		}

		if ( !$ret) {
			Log::error("username <$userName> not found");
		}

		return $ret;

	}

	static public function getLoggedUserFullName() {

		$funcionario = Funcionario::searchByUsername(Auth::user()->username);

		if (isset($funcionario)) {
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

		if(Auth::user())
		{
			$funcionario = Funcionario::searchByUsername(Auth::user()->username);

			if (isset($funcionario)) {
				return $funcionario->id;
			}
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
				// $hora->hora_saida = $horaEntrada->setTime($h[0],$h[1],0);
				// Schneider mandou colocar a hora de saída igual à hora de entrada se o usuário esquecer de sair
				$hora->hora_saida = App\Models\Event::getLastEventTime($this->id, $hora->hora_entrada);
				$hora->saida_automatica = true;
				$hora->save();
			} else {
				return true;
			}
		}

		return false;

	}

	public function getCurrentLoginTime()
	{
		$horas = Hora::where('funcionario_id', $this->id)->whereNull('hora_saida')->get();

		$today = (new DateTime)->setTime(0,0,0);

		foreach($horas as $hora) {
			$horaEntrada = (new DateTime($hora->hora_entrada))->setTime(0,0,0);
			if ($horaEntrada >= $today) {
				return $hora;
			}
		}

		return null;
	}

	public function logIn() {
		if ( ! $this->isLoggedIn() )
		{
			$user = Funcionario::getLoggedUserId();
			$hora = new Hora;
			$hora->funcionario_id = $this->id;
			$hora->hora_entrada = new DateTime;
			$hora->funcionario_informou_id = $user ?: -999;
			$hora->save();
		}
	}

	public function logOut() {
		if ( $this->isLoggedIn() )
		{
			$hora = $this->getCurrentLoginTime();

			$hora->hora_saida = new DateTime; /// logout now

			$hora->save();
		}
	}

	public function isCurrentUser() 
	{
		return $this->id === $this->getLoggedUserId();
	}

	public function ramais() {
		
		$ramais = $this->ramal;

		if (isset($this->ramal_movel)) {
			$ramais = $ramais . (!empty($ramais) ? ' e ' : '') . "$this->ramal_movel (móvel)";
		}

		return $ramais;
	}

	public static function authenticate($username, $password)
	{
		if ( ! static::tryAuthenticate($username, $password) )
		{
			return false;
		}

		$user = Funcionario::searchByUsername($username);

		if ( empty($user) )
		{
			$user = Funcionario::addLDAPUser($username);
		}

		Auth::loginUsingId($user->id);

		return true;
	}

	public static function tryAuthenticate($username, $password)
	{
		if ( LDAP::authenticate($username, $password) ) return true;

		$funcionario = Funcionario::searchByUsername($username);

		if ( ! empty($funcionario))
		{
			if ( LDAP::authenticate($funcionario->usuario, $password) ) return true;

			if ( LDAP::authenticate($funcionario->nome, $password) ) return true;
		}

		return false;
	}

	public static function workHours($funcionario, $dateStart, $dateEnd) 
	{
		if ($dateStart > Carbon::today()) return null;

		if ( ! $funcionario instanceof Funcionario)
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

	public static function addLDAPUser($username)
	{
		$user = LDAP::searchUser($username);
		///$user = LDAP::searchUser('mcmachado');

		$input = 	[
						'matricula' => $user[0]['description'][0],
						'nome' => $user[0]['displayname'][0],
						'divisao' => 'SDGI',
						'email' => $user[0]['cn'][0].'@alerj.rj.gov.br',
						'usuario' => $user[0]['cn'][0],
						'horario_limite' => '19:00:00',
					];

		Tools::utf8EncodeArray($input);

		return Funcionario::create($input);
	}
}

