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

use Illuminate\Filesystem\Filesystem;

Route::get('test', function() {

	$func = Funcionario::firstOrCreate(['id' => 100, 'matricula' => '201', 'divisao' => '201', 'usuario' => '201', 'email' => '201',   'nome' => 'zé']);

	dd($func);

	$func = Funcionario::find(1);
	$horas = $func->horas()->descriptionLess()->get();

	dd($horas);

    dd( array_merge ( $func, $func ) );

	dd([$func, $func]);

	dd( $func );

	dd( Funcionario::sum('id') );

	$records = DB::table('datas')->whereData( $date )->get();

	d( $date );
	dd( $records );


	// return Form::open(['url' => 'abcd']);
	
	// dd( DB::select(DB::raw('select * from funcionarios')) );

	//return View::make('_partials.colorDepht');
	//
	
// 	$matches = Funcionario::where('id','>',0);
// 	$user_query = "sonic hedgehog";

// foreach(explode(' ', $user_query) as $word)
// {
//     $matches = $matches->orWhere('usuario', 'LIKE', $word);
//     $matches = $matches->orWhere('usuario', 'LIKE', $word);
// }

//     $matches = $matches->paginate(10);

// 	var_dump($matches);

});	

Route::get('login', array('as' => 'loginForm', 'uses' => 'FuncionariosController@loginForm'));

Route::post('login', array('as' => 'login', 'before' => 'csrf', 'uses' => 'FuncionariosController@login') );

Route::get('event/{token}/{user}/{console}/{event}', array('as' => 'event', 'uses' => 'EventsController@fire'));

Route::get('expired', array('as' => 'expired', 'uses' => 'FuncionariosController@expired'));

Route::group(array('before' => 'auth'), function()
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
