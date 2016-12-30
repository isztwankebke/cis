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
	public function admin_read() {
		
		try {
			
			//prepare view for both Request Method
			$layout = parent::isGrant();
			$view = new View();
			$client = new ClientModel();
			$pagination = new PaginationsController();
			
			
			if ($this->request->isGet()) {
			/*	
				$clients = $client->admin_read();
				
				
				*/
				if (empty($this->request->getParameters())) {
						
					//settings for default attributes
					$paginationSetup = $pagination->setPaginationAttributes();
						
				}
				else {
						
					//setting attributes from view
					$paginationSetup = $pagination->setPaginationAttributes(null, $this->request->getParameters()[0]);
						
					//check request has set a clientData
					if (isset($this->request->getParameters()[1])) {
				
						$searchData['clientData'] = $this->request->getParameters()[1];
					}
				}
				
				if (isset($searchData)) {
					//when searchData is set
					$data = $client->search($searchData, $paginationSetup);
						
				}
				else {
						
					//display default all transactions with attributes from pagination
					$data = $client->admin_read(null, $paginationSetup);
				}
				
				$view->set('Clients/admin_read', $data, $layout);
				//var_dump($client->getQueryLog());
			}
			
			elseif ($this->request->isPost()) {
			
				$searchData = $this->request->getPostData();
				//var_dump($searchData);
				$paginationSetup = $pagination->setPaginationAttributes();
				
				$data = $client->search($searchData, $paginationSetup);
				
				//if data is not empy client matched - search transaction,
				//otherwise display warning
				
				if ($data) {
						
					$view->set('Clients/admin_read', $data, $layout);
						
				}
				else {
					
					$data = -1;
					$view->set('Clients/admin_read', $data, $layout);
				}
				
				
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