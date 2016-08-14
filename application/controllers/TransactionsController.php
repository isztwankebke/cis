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
	 *
	 * @param unknown $parameters
	 */
	public function addTransaction($parameters) {
	
		try {
				
			if ($this->request->isGet()) { //replace Get with POST
	
				$clientData = $this->getClient($parameters);
				$productData = $this->getProduct($parameters);
	
				$transaction = new TransactionModel();
				$transaction->addTransaction($clientData, $productData, $parameters);
				return $transaction->getTransactionData();
	
			}
			else {
				return false;
			}
		}
		catch (Exception $e) {
			echo "Caught exception: ", $e->getMessage();
		}
	}
	
	
	
	/**
	 *
	 * @param unknown $parameters
	 * @return unknown[]
	 */
	public function editTransaction($parameters) {
		try {
			if($this->request->isGet()) {
	
				$transaction = new TransactionModel();
				$transaction->edtitTransaction($parameters);
				return $transaction->getTransactionData();
			}
				
		}
		catch (Exception$e) {
			echo "caugh Exception: ", $e->getMessage();
		}
	}
	
	
	public function index() {
		
		if ($this->request->isGet()) {
			$view = new View();
			$view->set('transactions/index');
			$view->render();	
		}
		
	}
	public function search() {
		
		if ($this->request->isPost()){
			
			$transaction = new TransactionModel();
			$searchData = $this->request->getPostData();
			
			if (debug) {
			var_dump($_POST);
			var_dump($searchData);
			}
			
			$data = $transaction->search($searchData);
			
			//var_dump($client->search($searchData));
			
			$view = new View();
			$view->set('transactions/search', $data);
			$view->render();
			
			//$transaction = new TransactionModel();
			//$transactionData = $this->request->getPostData();
			//var_dump($transaction->search($searchData));
				
		}
		
	}
	
	
}