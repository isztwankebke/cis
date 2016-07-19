<?php
class DATABASE_CONFIG {


	// default is for local developer
	public $default = array(
			'datasource' => '',//Database/Mysql',
			'persistent' => false,
			'host' => 'localhost',
			'login' => 'alojzy',
			'password' => 'blabla1@',
			'database' => 'cis_db',
			'prefix' => '',
			//'encoding' => 'utf8',
	);

/*
	// configuration for online 
	public $develop = array(
			'datasource' => 'Database/Mysql',
			'persistent' => false,
			'host' => 'localhost',
			'login' => 'devremo',
			'password' => 'KGhbj6OX',
			'database' => 'devremo',
			'prefix' => '',
			//'encoding' => 'utf8',
	);


	// configuration for online staging.remo.io
	public $staging = array(
			'datasource' => 'Database/Mysql',
			'persistent' => false,
			'host' => 'localhost',
			'login' => 'remostaging',
			'password' => 'KGhbj6OX',
			'database' => 'remostaging',
			'prefix' => '',
			//'encoding' => 'utf8',
	);


	public $production = array(
			'datasource' => 'Database/Mysql',
			'persistent' => false,
			'host' => '',
			'login' => '',
			'password' => '',
			'database' => '',
			'prefix' => '',
			//'encoding' => 'utf8',
	);

	public $test = array(
			'datasource' => 'Database/Mysql',
			'persistent' => false,
			'host' => 'localhost',
			'login' => 'test_cis',
			'password' => 'tMdXbqhGrszUwxmh',
			'database' => 'test_remo',
			'prefix' => '',
			//'encoding' => 'utf8',
	);
*/

	public function __construct() {
		 
		// invocating on production server
		if (isset($_SERVER['LOGNAME']) && $_SERVER['LOGNAME'] == 'blabla') {
			$this->default = $this->staging;
		}
		else if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == 'blabla') {
			$this->default = $this->staging;
		}
		else if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == 'blabla') {
			$this->default = $this->develop;
		}
		else if (php_uname("n") == 'blabla') {
			$this->default = $this->production;
		}
		else {
			$this->default = $this->default;
		}
	}
}
