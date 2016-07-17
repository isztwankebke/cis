<?php
//to robi akcja
//1.pobrac dane
//2.zweryfikowac czy sa prawidlowa
//3.wykonac odpowiednia akcje
//4 zwrocic do widoku albo wyrenderowac widok

//jak bedzie blad

class UsersController extends Controller {
	
	/**
	 * 
	 * @param Request $request
	 */
	function __construct(Request $request) {
		
		parent::__construct($request);
		//echo "UserController";
		//
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
	
	
	
	public function addClient ($parameters) {
		
		$pesel;
		$name;
		$surname;
		$phoneNumber;
		$productName;
		$initDate;
		$productName;
		$period;
		$endDate;
		$extraInfo;
		
		
		
		
	}
	
	
	
	
	
	
	/**
	 * print echo echo on screen
	 * @param unknown $parameters
	 */
	public function printName ($parameters) {
		var_dump($parameters);
		
		var_dump($parameters['imie']);
		
	}
	
}