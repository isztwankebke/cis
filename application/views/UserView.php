<?php
class UserView {
	
	private $user;
	private $controller;
	
	public function __construct($controller, $user) {
		
		$this->user = $user;
		$this->controller = $controller;
		
	}
	
	public function output() {
		return '<p><a href="mvc.php?action=clicked"'.$this->user->string."</a></p>";
	}
}