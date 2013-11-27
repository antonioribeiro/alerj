<?php

return array(

	'fetch' => PDO::FETCH_CLASS,

	'default'  => 'sdgipa', /// sdgi proxy admin
	'sara'     => 'sara',
	'adm_user' => 'adm_user',

	'connections' => array(

		'sdgipa' => array(
			'driver'   => 'sqlsrv',
			'host'     => 'al12',
			'database' => 'SDGIPA',
			'username' => 'AL\uteste',
			'password' => 'trocar',
			'prefix'   => '',
		),

		'sara' => array(
			'driver'   => 'sqlsrv',
			'host'     => 'al12',
			'database' => 'sara',
			'username' => 'AL\uteste',
			'password' => 'trocar',
			'prefix'   => '',
		),

		'adm_user' => array(
			'driver'   => 'sqlsrv',
			'host'     => 'al12',
			'database' => 'ADM_USER_ANT',
			'username' => 'AL\uteste',
			'password' => 'trocar',
			'prefix'   => '',
		),

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'testing',
			'username'  => 'root',
			'password'  => 'foda-se',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),		

	),

	'migrations' => 'dbo.migrations',

	'redis' => array(

		'cluster' => true,

		'default' => array(
			'host'     => '127.0.0.1',
			'port'     => 6379,
			'database' => 0,
		),

	),

);
