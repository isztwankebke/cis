<?php

class UsersController extends Controller {
	function __construct() {
		
		//echo "UserController";
	}
	
	public function dodajKlienta($parameters) {
		
		//$parameters = implode(", ", $parameters);
		echo "<br>Dane klienta do dodania:<br>";
		var_dump($parameters);
	}
	
	
}