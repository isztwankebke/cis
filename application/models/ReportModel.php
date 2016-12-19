<?php

class ReportModel extends Model {

	public  $string;

	public function __construct() {
		parent::__construct();
		$this->string = "blabla, Click here to start!";

	}
	
	public function exportToFile ($data) {
		
		var_dump($data);
		var_dump($_SESSION);
		die;
	}
}