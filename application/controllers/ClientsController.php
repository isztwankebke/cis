<?php
class ClientsController extends Controller {

	public $clients = null;

	/**
	 *
	 * @param Request $request
	 */
	function __construct(Request $request) {

		parent::__construct($request);
		parent::sessionTimeout();
		parent::isLogged();
		
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
	public function admin_read() {
		
		try {
			
			$layout = parent::isGrant();
			
			if ($this->request->isGet()) {
				//$this->autoRender = false;
				$client = new ClientModel();
				
				$clients = $client->admin_read();
				
				$view = new View();
				
				$view->set('Clients/admin_read', $clients, $layout);
				
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
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	/**
	 * 
	 */
	public function admin_editClient() {
		
		try {
			
			$layout = parent::isGrant();
			
			$view = new View();
			$client = new ClientModel();
				
			if ($this->request->isGet()) {
		
				$parameters = $this->request->getParameters();
				$result = $client->readClient($parameters);
					
				if (debug) {
					var_dump($parameters);
					var_dump($result);
				}
		
				$view->set('Clients/admin_editClient', $result, $layout);
		
			}
			else if ($this->request->isPost()) {
				$parameters = $this->request->getPostData();
				$result = $client->editClient($parameters);
				$view->set('Clients/confirmation', $result, $layout);
			}
				
			$view->render();
				
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
		
	}

	
	
	public function admin_deleteClient() {
	
		try {
			
			$layout = parent::isGrant();
			
			$view = new View();
			$client = new ClientModel();
			$transaction = new TransactionModel();
	
			if ($this->request->isGet()) {
	
				$clientID = $this->request->getParameters();
				//var_dump($clientID[0]);
				$transactions = $transaction->getClientTransaction($clientID[0]);
				//var_dump($transactions);
				
				if (empty($transactions)) {
					
					$clientData = $client->readClient($clientID);
					$view->set('Clients/admin_deleteClient', $clientData, $layout);
				}
				else {
					
					$view->set('Clients/admin_deleteClientWithTransactions', $transactions, $layout);
				}
					
					
				
					
				if (debug) {
					var_dump($clientID);
					var_dump($transactions);
				}
	
				
	
			}
			else if ($this->request->isPost()) {
				$parameters = $this->request->getPostData();
				//var_dump($parameters);
				$result = $client->deleteClient($parameters);
				$view->set('Clients/delete_confirmation', $result, $layout);
			}
			
			$view->render();
	
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
		
		
	
	}






}