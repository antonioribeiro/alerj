<?php

	require '../vendor/autoload.php';

	$input = Illuminate\Http\Request::createFromGlobals();

	echo "<pre>";
	
	var_dump($input->getPathInfo());

	var_dump($input->all());
