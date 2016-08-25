<?php
class ClientsController extends Controller {

	public $clients = null;

	/**
	 *
	 * @param Request $request
	 */
	function __construct(Request $request) {

		parent::__construct($request);

	}
		
	

	/**
	 * EDIT CLIENT
	 * @param unknown $parameters
	 */
	public function edit() {
	
		if ($this->request->isPost()) {
			$dataToChange = $this->request->getPostData();
			$parameters = $this->request->getParameters('get');
			
			$client = new ClientModel();
			$client->edit($dataToChange, $parameters);
			$client->getClientData();
		}
		
	}
	
	
	
	/**
	 * 
	 */
	public function addClient() {
		if ($this->request->isPost()) {
			
			$client = new ClientModel();
			$clientData = $this->request->getPostData();
			$client->addClient($clientData);
		}
		
	}
	
	
	
	/**
	 * 
	 */
	public function search() {
		if ($this->request->isPost()){
			
			$client = new ClientModel();
			$searchData = $this->request->getPostData();
			var_dump($client->search($searchData));
			
		}
		
	}
	public function renderView($viewName, $parameters) {
		
		$clients = $parameters;
		// $parameters['clients'];
		extract($parameters);
		
		
		///$clients
		// nazwa widoku, ktory zainclugowac
		// parametry widoku
		include '../application/views/Layouts/default.php';
	}
	
	
	/**
	 * 
	 */
	public function read() {
		
		if ($this->request->isGet()) {
			$this->autoRender = false;
			$client = new ClientModel();
			
			$clients = $client->read();
			$view = new View();
			if ($_SESSION['grant'] == 1) {
				
				$view->set('Clients/read', $clients, 'admin');
			}
			else {
				$view->set('Users/admin_fault');
			}
			$view->render();
			
			/*$path = preg_split('/Controller::/', __METHOD__);
			$this->view = '../application/views/'. $path[0] . '/' . $path[1]. '.php';
			
			//$this->clients = $clients;
			$viewName = $this->view;
			var_dump($this->view);
			
			var_dump(ClientsController::setView());
			
			//$this->view->set('clients', $clients);
			//$this->renderView('Clients/read', ['clients' => $clients]);
			*/
			//$this->renderView($viewName, $clients);
			// jak do layoutu przekazac nazwe widoku i jego parametry?
			// include 'default layout';
		}
	}







}