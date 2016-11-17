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
		parent::sessionTimeout();
		//can not use parrent:isLogged!!
		
	}
	
	
	/**
	 * 
	 */
	 public function test($parameters) {
		
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
	
	
	
	/**
	 * 
	 */
	public function admin_index() {
		
		parent::isLogged();
		
		$layout = parent::isGrant();
		
		if ($this->request->isGet()) {
			
			$view = new View();
			$view->set('Users/admin_index', null, $layout);
			
		}
		
		$view->render();
		
	}
	
	
	
	/**
	 * 
	 */
	public function admin_read() {
		
		parent::isLogged();
		
		$layout = parent::isGrant();
		
		$user = new UserModel();
		$users = $user->admin_read();
		
		$view = new View();
		
		$view->set('Users/admin_read', $users, $layout);
		
		$view->render();
	}
	
	
	
	/**
	 * 
	 */
	public function index() {
		
		parent::isLogged();
		
		$layout = parent::isSupervisor();
		//var_dump($layout);
		$view = new View();
		$view->set('Users/index', null, $layout);
		$view->render();
		
	}
	
	
	
	/**
	 * 
	 */
	public function login() {
		
		$view = new View();
		
		if ($this->request->isPost()) {
		
			$loginData = $this->request->getPostData();
			$user = new UserModel();
			$loging = $user->login($loginData);
			if (debug) {
				var_dump($loging);
			}
			if (!$loging) {
				$fault = 'Wrong name or password. Please try again.';
				$view->set('Users/login', $fault, 'login');	
			}
			else {
				$layout = parent::isSupervisor();
				$view->set('Users/index', null, $layout);
			}
		}
		elseif ($this->request->isGet()) {
			
			$view->set('Users/login', null, 'login');
		}
			$view->render();
			
		
	}
	
	
	
	/**
	 * 
	 */
	public function logout() {
		
		if ($this->request->isGet()) {
			
			$user = new UserModel();
			$user->logout();
			$this->login();
		}
	}
	
	
	
	/**
	 * 
	 */
	public function admin_addUser() {
		
		try {
			parent::isLogged();
			
			$layout = parent::isGrant();
			
			$view = new View();
			
			//var_dump($layout);
		
			if ($this->request->isGet()) {
				$view->set('Users/admin_addUser', null, $layout);
				
				
			}
			elseif ($this->request->isPost()) {
				$user = new UserModel();
				$userData = $this->request->getPostData();
				$result = $user->admin_addUser($userData);
				$view->set('Users/confirmation', $result, $layout);
				
			}
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
		
	}
	
	
	
	/**
	 * 
	 */
	public function admin_passwordChange() {
		
		try {
			
			parent::isLogged();
			
			$layout = parent::isGrant();
			
			$view = new View();
			$user = new UserModel();
			
			if ($this->request->isGet()) {
				
				$parameters = $this->request->getParameters();
				$userData = $user->getUser($parameters);
				$view->set('Users/admin_passwordChange', $userData, $layout);
			}
			
			elseif ($this->request->isPost()) {
				
				$parameters = $this->request->getPostData();
				$result = $user->passwordChange($parameters);
				$view->set('Users/confirmation', $result, $layout);
			}
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	/**
	 * 
	 */
	public function admin_deleteUser() {
		
		try {
			parent::isLogged();
			
			$layout = parent::isGrant();
			
			$view = new View();
			$user = new UserModel();
			
			if ($this->request->isGet()) {
				
				$parameters = $this->request->getParameters();
				$userData = $user->getUser($parameters);
				$view->set('Users/admin_deleteUser', $userData, $layout);
			}
			
			elseif ($this->request->isPost()) {
			
				$parameters = $this->request->getPostData();
				$result = $user->deleteUser($parameters);
				$view->set('Users/delete_confirmation', $result, $layout);
			}
			
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	/**
	 * 
	 */
	public function admin_editUser() {
		
		try {
			
			parent::isLogged();
			
			$layout = parent::isGrant();
			
			$view = new View();
			$user = new UserModel();
			
			if ($this->request->isGet()) {
		
				$parameters = $this->request->getParameters();
				$userData = $user->getUser($parameters);
				$view->set('Users/admin_editUser', $userData, $layout);
			}
				
			elseif ($this->request->isPost()) {
					
				$parameters = $this->request->getPostData();
				$result = $user->editUser($parameters);
				$view->set('Users/confirmation', $result, $layout);
			}
				
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	/**
	 * 
	 */
	public function supervisor_ammountCredit() {
		try {
			
			parent::isLogged();
			
			$layout = parent::isSupervisor();
			
			$ammounts = new UserModel();
			$view = new View();
			
			
			
			
			if ($this->request->isGet()) {
				
				$ammount = $ammounts->supervisor_ammountCredit();
				
				
			}
			
			elseif ($this->request->isPost()) {
				
				$month = $this->request->getPostData();
				$ammount = $ammounts->supervisor_ammountCredit($month);
				
				
			}
			$view->set('Users/supervisor_ammountCredit', $ammount, $layout);
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
}