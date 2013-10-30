<?php

use Toyota\Component\Ldap\Core\Manager;
use Toyota\Component\Ldap\Platform\Native\Driver;

class AuthController extends BaseController {

	public function __construct(LDAP $ldap)
	{
		$this->ldap = $ldap;
	}

	public function loginForm()
	{
		if ( ! Auth::guest())
		{
			return View::make('site.common.message')
					->with('message','Você está logado como <strong>'.Auth::user()->nome_usuario.'</strong>');
		}

		return View::make('site.auth.login');
	}

	public function login()
	{
		if ( $this->ldap->authenticate( Input::get('username'), Input::get('password') ) )
		{
			$user = User::where('nome_windows_usuario', Input::get('username'))->first();

			Auth::login( $user );

			return Redirect::to('message')
					->with('message', 'Usuário <strong>'.Auth::user()->nome_usuario.'</strong> efetuou login com sucesso.');
		}

		return Redirect::refresh()->with('error', 'Usuário ou senha incorreta.');
	}

	public function logout()
	{

		if ( ! Auth::guest())
		{
			Auth::logout();

			return Redirect::to('message')
					->with('message', 'Você efetuou logout.');					
		}

		return Redirect::to('login');	

	}

	public function forbidden()
	{

		return Redirect::to('message')
				->with('message', 'Você não está autorizado a usar este sistema.');					

	}
}