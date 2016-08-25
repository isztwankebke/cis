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
		
		if ($this->request->isGet()) {
			
			$view = new View();
			
			if ($_SESSION['grant'] == 1) {
				$view->set('Users/admin_index',null ,'admin');
			}
			else {
				$view->set('Users/admin_fault');
			}
			
			
			$view->render();
		}
	}
	
	
	
	public function read() {
		
		$user = new UserModel();
		$users = $user->read();
		
		$view = new View();
		
		if ($_SESSION['grant'] == 1) {
			$view->set('Users/read', $users, 'admin');
		}
		else {
			$view->set('Users/admin_fault');
		}
		
		$view->render();
	}
	
	
	
	/**
	 * 
	 */
	public function index() {
		$view = new View();
		$view->set('Users/index');
		$view->render();
		
	}
	
	public function login() {
		
		$view = new View();
		
		if ($this->request->isPost()) {
		
			$loginData = $this->request->getPostData();
			$user = new UserModel();
			$loging = $user->login($loginData);
			
			if (!$loging) {
				$fault = 'Wrong name or password. Please try again.';
				$view->set('Users/login', $fault, 'login');	
			}
			else {
				$view->set('Users/index');
			}
		}
		elseif ($this->request->isGet()) {
			
			$view->set('Users/login', null, 'login');
		}
			$view->render();
			
		
	}
	
	
	public function logout() {
		
		if ($this->request->isGet()) {
			
			$user = new UserModel();
			$user->logout();
			$view = new View();
			$view->set('Users/login', null, 'login');
			$view->render();
		}
	}
	
	
	
}