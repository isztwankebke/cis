<?php
class Controller {
	
	
	/**
	 * 
	 * @var Request
	 */
	protected $request = null;
	
	
	protected $session = null;
	//protected $view = null;
	
	protected $autoRender = true;
	
	/**
	 * 
	 * @param Request $request
	 */
	public function __construct(Request $request) {
		
		$this->request = $request;
		session_start();
		
		
	}
	
	public function isLogged() {
		if (!isset($_SESSION['id'])) {
			$view = new View();
			$view->set('Users\login');
			$view->render();
		}
	}
	
	
	
	
	
		
	
}