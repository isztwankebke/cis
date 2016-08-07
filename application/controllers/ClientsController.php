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
	public function renderView($parameters) {
		$clients = $parameters;
		include '../application/views/Layouts/default.php';
	}
	
	
	/**
	 * 
	 */
	public function read() {
		
		if ($this->request->isGet()) {
			
			$client = new ClientModel();
			$clients = $client->read();
			//$this->clients = $clients;
			$this->renderView($clients);
			
			// jak do layoutu przekazac nazwe widoku i jego parametry?
			// include 'default layout';
		}
	}







}