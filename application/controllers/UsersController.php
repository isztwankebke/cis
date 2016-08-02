<?php
//to robi akcja
//1.pobrac dane
//2.zweryfikowac czy sa prawidlowa
//3.wykonac odpowiednia akcje
//4 zwrocic do widoku albo wyrenderowac widok

//jak bedzie blad

class UsersController extends Controller {
	
	private $userId = NULL;
	private $userName = NULL;
	private $userPassword = NULL;
	private $userEmail = NULL;
	private $created = NULL;
	private $modified = NULL;
	private $lastLogin = NULL;
	private $name = NULL;
	private $surname = NULL;
	private $grantAccess = NULL;
	private $UserData = NULL;
	

	
	/**
	 * 
	 * @param Request $request
	 */
	function __construct(Request $request) {
		
		parent::__construct($request);
		
	}
	
	
	/**
	 * 
	 */public function test($parameters) {
		
		$this->session->read('User');
		if ($this->request->isGet()) {
			// wylistuj cos
		}
		else if ($this->request->isPost()) {
			// czyzby dane z formularza ?
		}
		else {
			// nie obslugujemy innych zapytan typu PUT, DELETE.
		}
		//$parameters = implode(", ", $parameters);
		echo "<br>Dane klienta do dodania:<br>";
		var_dump($parameters);
	}
	
	
	
	
	
	
	
}