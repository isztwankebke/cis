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
		$_SESSION['supervisor'] = $result[0]['supervisor'];
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('EUROPE/WARSAW'));
		$lastLogin = $date->format('Y-m-d H:i:s');
		$sql = "UPDATE 
				users 
				SET 
				users.last_login ='{$lastLogin}' 
				WHERE 
				users.id = '{$result[0]['id']}'";
		$updateUser = parent::query($sql);
		
		if (debug) {
			var_dump($result);
		}
		return $result;
		//go to begin page of system
	}
	
	
	
	/**
	 * 
	 */
	public function logout() {
		
		session_unset();
		session_destroy();
		
	}
	
	
	public function register($password) {
		
		$password = sha1($password);
		return $password;
		
		// to zapisz w bazie!
	}
	
	
	
	/**
	 * 
	 * @return false if no user or array of Users
	 */
	public function admin_read() {
		
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
	
	
	
	public function admin_addUser($userData) {
		//check is data recived from post is consistent
		//check is user exist
		//add user if both above is correct
		if (!$this->checkUserData($userData)) {
			return false;
		}
		
		if ($this->isUserExist($userData)) {
			
			throw new Exception('user already exist');
			return false;
		}
		if (isset($userData['grant_access'])) {
		
			$grant = 1;
		}
		else {
			$grant = 0;
		}
		//check password consistent
		if ($passwordErr = $this->checkPassword($userData['password'])) {
			throw new Exception($passwordErr);
			return false;
		}
		
		$password = $this->register($userData['password']);
		$date = new DateTime();
		$created = $date->format('Y-m-d H:i:s');
		
		$sql = "INSERT 
				INTO 
				users
				(`username`, `email`, `password`, `created`, `name`, `surname`, `grant_access`) 
				VALUES 
				('{$userData['username']}','{$userData['email']}',
				'{$password}','{$created}','{$userData['name']}',
				'{$userData['surname']}','{$grant}')";
		
		$result = parent::query($sql);
		
		if (!$result) {
			
			return false;
		}
		
		return $result;
		
	}
	
	
	/**
	 * 
	 * @param $userData
	 * @throws return true if user data is valid
	 */
	public function checkUserData($userData) {
		
		if (!isset($userData['username'], 
					$userData['name'],
					$userData['surname'],
					$userData['email'])) {
				
			throw new Exception("User value not valid");
			return false;
		}
		
		if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
			throw new Exception('Email is not valid');
			return false;
		}
		
		
		//check is input value is alphanumeric
		if (!ctype_alnum($userData['username']) &&
			!ctype_alnum($userData['name']) &&
			!ctype_alnum($userData['surname'])) {
				
			throw new Exception('User data is not in valid format (only alphanumeric signs)');
			return false;
				
		}
		
		return true;
		
	}
	
	
	public function checkPassword($password) {
		
		if (strlen($password) <= '7') {
			
			return $passwordErr = "Your Password Must Contain At Least 8 Characters!";
		}
		elseif(!preg_match("#[0-9]+#",$password)) {
			
			return $passwordErr = "Your Password Must Contain At Least 1 Number!";
		}
		elseif(!preg_match("#[A-Z]+#",$password)) {
			
			return $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
		}
		elseif(!preg_match("#[a-z]+#",$password)) {
			
			return $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
		}
		return false;
		
	}
	
	
	
	/**
	 * 
	 * @param $userData
	 * return true if user exist
	 * return false if not
	 */
	public function isUserExist($userData) {
		
		$sql = "SELECT 
				*
				FROM
				users
				WHERE
				users.username = '{$userData['username']}'
				OR
				(users.name = '{$userData['name']}'
				AND
				users.surname = '{$userData['surname']}'
				AND
				users.email = '{$userData['email']}')";
		$result = parent::query($sql);
		
		if ($result) {
			return true;
		}
		
		return false;
	}
	
	
	public function passwordChange($parameters) {
		//validate password is match in both inputs
		//validate password is correct
		//change password
		//var_dump($parameters);
		if (!isset($parameters['password'], $parameters['reTypePassword'])) {
			throw new Exception("Password field can not be empty");
			return false;
		}
		if ($parameters['password'] != $parameters['reTypePassword']) {
			
			throw new Exception("password not match");
			return false;
		}
		
		if ($passwordErr = $this->checkPassword($parameters['password'])) {
			
			throw new Exception($passwordErr);
			return false;
		}
		
		$password = $this->register($parameters['password']);
		
		$now = new DateTime();
		$now->setTimezone(new DateTimeZone('EUROPE/WARSAW'));
		$dateModified = $now->format('Y-m-d H:i:s');
		
		$sql = "UPDATE 
				users 
				SET 
				`password`='{$password}', `modified`='{$dateModified}'
				WHERE users.id = '{$parameters['id']}'";
		
		$result = parent::query($sql);
		
		if (!$result) {
			return false;
		}
					
		return $result;
		
	}
	
	
	
	/**
	 * 
	 * @param $parameters
	 * @return boolean
	 */
	public function getUser($parameters) {
		$sql = "SELECT
				*
				FROM
				users
				WHERE
				users.id = '{$parameters[0]}'";
		$result = parent::query($sql);
		
		if (!$result) {
			return false;
		}
		return $result;
	}
	
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @throws Exception
	 */
	public function deleteUser($parameters) {
		//admin cannot delete himself
		if ($parameters['id'] == $_SESSION['user_id']) {
			
			throw new Exception("It seems, that you want to delete self. It is prohibited!");
			return false;
		}
		$sql = "DELETE 
				FROM 
				`users` 
				WHERE 
				users.id = '{$parameters['id']}' ";
		$result = parent::query($sql);
		
		if (!$result) {
			
			return false;
		}
		return $result;
	}
	
	
	
	public function editUser($userData) {
		//check is data recived from post is consistent
		
		
		if (!$this->checkUserData($userData)) {
			return false;
		}
		
		if (isset($userData['grant_access'])) {
		
			$grant = 1;
		}
		else {
			$grant = 0;
		}
		
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('EUROPE/WARSAW'));
		$dateModified = $date->format('Y-m-d H:i:s');
		
		
		$sql = "UPDATE 
				users 
				SET 
				`username`='{$userData['username']}',
				`email`='{$userData['email']}',
				`modified`='{$dateModified}',
				`name`='{$userData['name']}',
				`surname`='{$userData['surname']}',
				`grant_access`='{$grant}' 
				WHERE users.id = '{$userData['id']}'";
		
		$result = parent::query($sql);
		
		if (!$result) {
				
			return false;
		}
		
		return $result;
	}
	
	
	
	public function supervisor_ammountCredit($month = NULL) {
		
		if (!$month) {
			
			$today = new DateTime('now');
			$month = $today->format('Y-m');
				
		}
		else {
			$month = $month['month'];
			//var_dump($month);
		}
		
		$sql = "SELECT
		SUM(transactions.credit_value)
		AS total
		FROM
		transactions
		WHERE
		transactions.init_date
		LIKE ('{$month}-%')";
			
		$result = parent::query($sql);
		return [$month,$result];
		
	}
}