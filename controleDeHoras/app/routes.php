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
	return View::make('_partials.colorDepht');
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
