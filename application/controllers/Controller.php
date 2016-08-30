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
		//$_SESSION['LAST_ACTIVITY'] = time();
		
		if (debug) {
			var_dump($_SESSION);
		}
		
		
	}
	
	public function isLogged() {
		//check if user is not logged in, redirect to login page
		if (!isset($_SESSION['user_id'])) {
			$view = new View();
			$view->set('Users\login', null, 'login');
			$view->render();
			
			die;
			
		}
	}
	
	
	public function sessionTimeout() {
		
		if (isset($_SESSION['LAST_ACTIVITY'])) {
			
			$timeout = 1800;
			if (debug) {
				$remainingTime = time() - $_SESSION['LAST_ACTIVITY'];
				var_dump($remainingTime);
			}
			
			if (time() - $_SESSION['LAST_ACTIVITY'] > $timeout) {
				
				// last request was more than 5 minutes ago
				session_unset();     // unset $_SESSION variable for the run-time
				session_destroy();
				// destroy session data in storage
			}
		}
		$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	}
	
	
	public function isGrant() {
		
		
		
		//check if user has grant to access site with admin action
	}
	
	
	
	
		
	
}