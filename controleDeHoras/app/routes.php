<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('tests', function() {

	// dd( DB::select(DB::raw('select * from funcionarios')) );

	//return View::make('_partials.colorDepht');
	//
	
	$matches = Funcionario::where('id','>',0);
	$user_query = "sonic hedgehog";

foreach(explode(' ', $user_query) as $word)
{
    $matches = $matches->orWhere('usuario', 'LIKE', $word);
    $matches = $matches->orWhere('usuario', 'LIKE', $word);
}

    $matches = $matches->paginate(10);

	var_dump($matches);

});	

Route::group(array('before' => 'auth.basic'), function()
{
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

	Route::get('logout', array('as' => 'logout', 'uses' => 'FuncionariosController@logout'));

	Route::resource('funcionarios', 'FuncionariosController');
	Route::get('funcionarios/{funcionarios}/frequency', array('as' => 'funcionarios.frequency', 'uses' => 'FuncionariosController@frequency'));

	Route::resource('horas', 'HorasController');

	Route::get('horas/toggle/{funcionarioId}', array('as' => 'horas.toggle', 'uses' => 'HorasController@toggle'));

	Route::get('reports/weekly', array('as' => 'reports.weekly', 'uses' => 'ReportsController@weekly'));

	Route::get('reports/xls/{week}/{year}', array('as' => 'reports.xls', 'uses' => 'ReportsController@xls'));

	Route::get('rdp', array('as' => 'rdp', 'uses' => 'HomeController@rdp'));

	Route::get('vpn', array('as' => 'vpn', 'uses' => 'HomeController@vpn'));

	Route::get('nojavascript', array('as' => 'nojavascript', 'uses' => 'HomeController@noJavascript'));
});


Route::group(array('prefix' => 'en'), function()
{
	Route::get('/', 'PageController@showHomepage');

	Route::group(array('prefix' => 'admin'), function()
	{
		Route::get('/', 'AdminPageController@showDashboard');
	});
});

Route::group(array('prefix' => 'admin'), function()
{
	Route::get('/', 'AdminPageController@showDashboard');
});
