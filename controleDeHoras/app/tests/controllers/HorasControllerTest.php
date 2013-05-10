<?php

class HorasControllerTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', 'horas');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		$response = $this->call('GET', 'horas/1');
		$this->assertTrue($response->isOk());
	}

	public function testCreate()
	{
		$response = $this->call('GET', 'horas/create');
		$this->assertTrue($response->isOk());
	}

	public function testEdit()
	{
		$response = $this->call('GET', 'horas/1/edit');
		$this->assertTrue($response->isOk());
	}
}
