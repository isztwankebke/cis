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
	public function login($loginData) {
		
		$username = $loginData['username'];
		$password = $loginData['password'];
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
		$_SESSION['user_id'] = $result[0]['id'];
		$_SESSION['grant'] = $result[0]['grant_access'];
		if (debug) {
			var_dump($result);
		}
		return $result;
		//go to begin page of system
	}
	
	
	
	public function logout() {
		
		session_unset();
		session_destroy();
		
	}
	
	
	public function register($email, $password) {
		
		$password = sha1($password);
		
		// to zapisz w bazie!
	}
	
	
	
	public function read() {
		
		$sql = "SELECT * 
				FROM 
				users 
				WHERE 1";
		
		$request = parent::query($sql);
		
		if (!$request) {
			return false;
		}
		
		return $request;
		
	}
}