<?php
class TransactionsController extends Controller {



	/**
	 *
	 * @param Request $request
	 */
	function __construct(Request $request) {

		parent::__construct($request);

	}
	
	
	
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
	







}