<?php

class FuncionariosControllerTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', 'funcionarios');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		$response = $this->call('GET', 'funcionarios/1');
		$this->assertTrue($response->isOk());
	}

	public function testCreate()
	{
		$response = $this->call('GET', 'funcionarios/create');
		$this->assertTrue($response->isOk());
	}

	public function testEdit()
	{
		$response = $this->call('GET', 'funcionarios/1/edit');
		$this->assertTrue($response->isOk());
	}
}
