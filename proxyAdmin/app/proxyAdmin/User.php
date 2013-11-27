<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'adm_user.dbo.usuario';

	protected $primaryKey = 'codigo_usuario';

	public function isAdministrator()
	{
		// aplicação = 16
		// perfil = 48
		// usuario = 23 = afaria
		// funcao = 342 = administrar proxy

		return PerfilUsuario::where('id_usuario', $this->codigo_usuario)->where('id_perfil', 48)->count() > 0;

	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}