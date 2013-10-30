<?php 

// DB::listen(function($sql) { echo "<pre>"; var_dump($sql); echo "</pre><br>"; });

Route::get('/login', array('as' => 'loginForm', 'uses' => 'AuthController@loginForm'));
Route::post('/login', array('as' => 'login', 'uses' => 'AuthController@login'));

Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@logout'));
Route::get('/loggedOut', array('as' => 'loggedOut', 'uses' => 'AuthController@loggedOut'));

Route::get('/message', array('as' => 'message', 'uses' => 'MessageController@message'));

Route::get('/forbidden', array('as' => 'forbidden', 'uses' => 'AuthController@forbidden'));

Route::get('/rights', array('as' => 'rights', 'uses' => 'ProxyController@rights'));

Route::group(array('before' => 'auth'), function()
{

	Route::group(array('before' => 'isAdministrator'), function()
	{

		Route::get('/', array('as' => 'home', 'uses' => 'DepartamentosController@index'));
		Route::get('/', array('as' => 'departamentos', 'uses' => 'DepartamentosController@index'));
		Route::get('departamento/{parent?}/{child?}', array('as' => 'departamento', 'uses' => 'DepartamentosController@index'));

		Route::get('usuarios/{id}', array('as' => 'usuarios', 'uses' => 'UsuariosController@index'));
		Route::get('proxy/{departamento}/{usuario}', array('as' => 'proxy', 'uses' => 'ProxyController@show'));
		Route::post('proxy/{departamento}/{usuario}/edit', array('as' => 'proxy.edit', 'uses' => 'ProxyController@edit'));

	});

});