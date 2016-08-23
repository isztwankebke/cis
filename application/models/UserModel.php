<?php
class UserModel extends Model {
	
	public  $string;

	public function __construct() {
		parent::__construct();
		$this->string = "blabla, Click here to start!";

	}
	
	
	/**
	 *
	 */
	public function login($username, $password) {
		
		$password = sha1($password);
		
		
		$sql = "SELECT * 
		FROM users 
		WHERE username = '{$username}' 
		AND password = '{$password}'
		LIMIT 1";
		
		$result = parent::query($sql);
	
		if (empty($result)) {
			//do somthing - error login or password
			return false;
		}
		return $result;
		//go to begin page of system
	}
	
	
	public function register($email, $password) {
		
		$password = sha1($password);
		
		// to zapisz w bazie!
	}
}