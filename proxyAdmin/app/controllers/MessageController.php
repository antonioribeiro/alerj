<?

class MessageController extends Controller {

	public function message($message = null)
	{
		
		if( !$message)
		{
			$message = Session::get('message');
		}

		return View::make('site.common.message')->with('message', $message);

	}

}