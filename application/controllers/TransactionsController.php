<?php
class TransactionsController extends Controller {

	
	
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
	 *
	 * @param unknown $parameters
	 */
	public function addTransaction() {
		try {
			//prepare view for both Request Method
			
			$view = new View();
		
			if ($this->request->isGet()) {
				
				$product = new ProductModel();
				$products = $product->admin_read();
				$view->set('Transactions/addTransaction',$products);
				
			}
			elseif ($this->request->isPost()) {
				
				$transactionData = $this->request->getPostData();
				$transaction = new TransactionModel();
				$result = $transaction->addTransaction($transactionData);
				$view->set('Transactions/confirmation', $result);
				if (debug) {
					var_dump($transactionData);
				}
			}
			
			$view->render();
		
		}
		catch (Exception $e) {
			echo "Caught exception: ", $e->getMessage();
		}
		
		
	/*
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
		}*/
	}
	/*
	public function confirmation() {
		try {
			
		
		if ($this->request->isPost()) {
			$view = new View();
			
			$product = new ProductModel();
			$products = $product->read();
				
			$transactionData = $this->request->getPostData();
			$transaction = new TransactionModel();
			$result = $transaction->addTransaction($transactionData);
			//$transactionData = array_merge($transactionData, $products);
			
			//$view->set('transactions/addTransaction', $transactionData);
			$view->set('Transactions/confirmation', $transactionData);
			
		}
		}
		
		catch (Exception $e) {
			echo "Caught exception: ", $e->getMessage();
		}
		$view->render();
		
	}
	*/
	
	
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
			$view->set('Transactions/index');
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
			
			if (debug) {
				var_dump($data);
			}
			//var_dump($client->search($searchData));
			
			$view = new View();
			$view->set('Transactions/search', $data);
			$view->render();
			
			//$transaction = new TransactionModel();
			//$transactionData = $this->request->getPostData();
			//var_dump($transaction->search($searchData));
				
		}
		
	}
	
	
}