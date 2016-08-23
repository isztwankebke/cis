<?php
class UserModel extends Model {

	public  $string;

	public function __construct() {
		parent::__construct();
		$this->string = "blabla, Click here to start!";

	}
	
	
}