<?php

class TestController extends BaseController {

	public function getIndex()
	{
		echo "a";
	}

	public function postSecond($a)
	{
		echo "b";
	}

}