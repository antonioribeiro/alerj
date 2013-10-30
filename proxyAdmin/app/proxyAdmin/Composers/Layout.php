<? namespace proxyAdmin\Composers;

use \Auth;

class Layout {

	public function compose($view)
	{
		if (Auth::guest())
		{
			$view->with('layoutLogout', 'Logout');
		}
		else
		{
			$view->with('layoutLogout', 'Logout ('.Auth::user()->nome_usuario.')');
		}
	}

}