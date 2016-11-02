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
	
	
	
	/**
	 * 
	 */
	public function admin_editTransaction() {
		try {
			
			$view = new View();
			$transaction = new TransactionModel();
			$product = new ProductModel();
			
			if ($this->request->isGet()) {
				
				$transactionId = $this->request->getParameters();
				//var_dump($transactionId);
				$transactionData = $transaction->getTransaction($transactionId[0]);
				$products = $product->admin_read();
				$dataToView = array($transactionData, $products);
				//var_dump($dataToView);
				$view->set('Transactions/admin_editTransaction', $dataToView, 'admin');
				
				
			}
			elseif ($this->request->isPost()) {
				
				$transactionData = $this->request->getPostData();
				//var_dump($transactionData);
				
				$update = $transaction->updateTransaction($transactionData);
				$view->set('Transactions/editTransactionConfirmation', $update, 'admin');
				
				
			}
			
			$view->render();
			
		
		}
		catch (Exception$e) {
			echo "caugh Exception: ", $e->getMessage();
		}	
	}
	
	
	
	/**
	 * 
	 */
	public function index() {
		
		if ($this->request->isGet()) {
			$view = new View();
			$view->set('Transactions/index');
			$view->render();	
		}
		
	}
	
	
	
	/**
	 * 
	 */
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
	
	
	
	public function admin_search() {
		try {
			//prepare view for both Request Method
				
			$view = new View();
		
			if ($this->request->isGet()) {
				
				$data = null;
				$view->set('Transactions/admin_search', $data, 'admin');
		
			}
			elseif ($this->request->isPost()) {
				
				$transaction = new TransactionModel();
				$searchData = $this->request->getPostData();
				$data = $transaction->search($searchData);
				
				//if data is not empy client matched - search transaction, 
				//otherwise display warning
				
				if ($data) {
					
					$view->set('Transactions/admin_search', $data, 'admin');
					
				}
				else {
					$data = -1;
					$view->set('Transactions/admin_search', $data, 'admin');
				}
				
			}
				
			$view->render();
		
		}
		catch (Exception $e) {
			echo "Caught exception: ", $e->getMessage();
		}
	}
	
	
	
	public function admin_deleteTransaction() {
		
		try {
				
			$view = new View();
			$transaction = new TransactionModel();
			
				
			if ($this->request->isGet()) {
		
				$transactionId = $this->request->getParameters();
				//var_dump($transactionId[0]);
				$transactionData= $transaction->getTransaction($transactionId[0]);
				$view->set('Transactions/deleteConfirmation', $transactionData, 'admin');
				
			}
			elseif ($this->request->isPost()) {
				
				$transactionId = $this->request->getPostData();
				
				//var_dump($transactionId['transactionId']);
				
				$transactionData = $transaction->deleteTransaction($transactionId['transactionId']);
				$view->set('Transactions/admin_deleteConfirmation', $transactionData, 'admin');
			}
				
			$view->render();
				
		
		}
		catch (Exception$e) {
			echo "caugh Exception: ", $e->getMessage();
		}
	}
	
}