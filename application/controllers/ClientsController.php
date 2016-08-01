<?php
class ClientsController extends Controller {



	/**
	 *
	 * @param Request $request
	 */
	function __construct(Request $request) {

		parent::__construct($request);

	}
	/*
	public function read($tableName = 'clients') {
		
		$clients = new ClientModel();
		$clients->read($tableName);
		
	}
	*/
	/**
	 * GET CLIENT
	 * @param unknown $parameters
	 */
	public function getClient($parameters) {
		$client = new ClientModel();
		$client->getClient($parameters);
		return $client->getClientData();
	
	}
	
	
	

	/**
	 * EDIT CLIENT
	 * @param unknown $parameters
	 */
	public function editClient($parameters) {
	
		$client = new ClientModel();
		$client->editClient($parameters);
		return $client->getClientData();
	}
	
	public function addClient() {
		if ($this->request->isPost()) {
			$client = new ClientModel();
			
			$clientData = $this->request->getPostData();
			var_dump($clientData);
			$client->addClient($clientData);
		}
		
	}
	public function search() {
		if ($this->request->isGet()){
			$parameters = $this->request->getParameters('get');
			$clients = new ClientModel();
			var_dump($clients->search($parameters));
			
			
		}
		
		
		
	}
	
	public function read() {
		
		$tableName = "clients";
		
		
		if ($this->request->isGet()) {
			$client = new ClientModel();
			var_dump($client->read($tableName));
			
		}
	}







}