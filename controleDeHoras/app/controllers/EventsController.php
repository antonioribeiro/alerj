<?php

class EventsController extends BaseController {

	public function fire($token, $user, $console, $event)
	{
		if ($token != 'K234092O35g4hjP2kl12bx1cv3bn6mAo4uhkjhwekZ')
		{
			return "error";
		}

		$funcionario = Funcionario::searchByUsername($user);

		if ( isset($funcionario) )
		{
			App\Models\Event::create([
							'funcionario_id' => $funcionario->id,
							'console' => $console,
							'event' => $event,
							'ip_address' => Request::getClientIp(),
			]);

			Log::info("event system - $event: $funcionario->nome");

			if ($console == 'local')
			{
				if( in_array($event, ['login','open','unlock']) )
				{
					if( ! $funcionario->isLoggedIn())
					{
						Log::info('event system - user automatically logged in: '.$funcionario->nome);
						$funcionario->logIn();
					}
					else
					{
						Log::info('event system - user is already logged in: '.$funcionario->nome);
					}
				}
				else
				{
					Log::info('event system - user is getting out: '.$funcionario->nome);
				}
			}
			else
			{
				Log::info('event system - user is in a remote station: '.$funcionario->nome);
			}

			return "ok";
		}
		else
		{
			Log::info('event system - ERROR - user not found: '+$user);
			return "error:u";
		}

	}

}

// http://10.17.12.250/controleDeHoras.development/event/K234092O35g4hjP2kl12bx1cv3bn6mAo4uhkjhwekZ/afaria/local/open;
