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
			$layout = parent::isSupervisor();
			
			$view = new View();
		
			if ($this->request->isGet()) {
				
				$product = new ProductModel();
				$products = $product->admin_read();
				$view->set('Transactions/addTransaction',$products, $layout);
				
			}
			elseif ($this->request->isPost()) {
				
				$transactionData = $this->request->getPostData();
				$transaction = new TransactionModel();
				$result = $transaction->addTransaction($transactionData);
				
				//var_dump($result[0]);
				
				//if transaction exist - ask if add the same transaction or cancel
				if ($result[0] == 'transaction exist') {
					
					$this->duplicateEntry($result);
					die;
				}
				$view->set('Transactions/confirmation', $result, $layout);
				if (debug) {
					var_dump($transactionData);
				}
			}
			
			$view->render();
		
		}
		catch (Exception $e) {
			echo "Caught exception: ", $e->getMessage();
			//var_dump($e->getTrace());
		}
		
		
	/*
		try {
				
			if ($this->request->isGet()) { //replace Get with POST
	
				$clientData = $this->getClient($parameters);
				$productData = $this->getProduct($parameters);
	
				$transaction = new TransactionModel();
				$transaction->addTransaction($clientData, $productData, $parameters);
				return $transaction->getTransactionData();
	
			
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
			
			$layout = parent::isGrant();
			
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
				$view->set('Transactions/admin_editTransaction', $dataToView, $layout);
				
				
			}
			elseif ($this->request->isPost()) {
				
				$transactionData = $this->request->getPostData();
				//var_dump($transactionData);
				
				$update = $transaction->updateTransaction($transactionData);
				$view->set('Transactions/editTransactionConfirmation', $update, $layout);
				
				
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
		
		$layout = parent::isSupervisor();
		
		if ($this->request->isGet()) {
			$view = new View();
			$view->set('Transactions/index', null, $layout);
			$view->render();	
		}
		
	}
	
	
	
	/**
	 * 
	 */
	public function search() {
		
		$layout = parent::isSupervisor();
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
			$view->set('Transactions/search', $data, $layout);
			$view->render();
			
			//$transaction = new TransactionModel();
			//$transactionData = $this->request->getPostData();
			//var_dump($transaction->search($searchData));
				
		}
		
	}
	
	
	
	public function admin_search() {
		try {
			
			//prepare view for both Request Method
			$layout = parent::isGrant();	
			$view = new View();
			$transaction = new TransactionModel();
			$pagination = new PaginationsController();
			
		
			if ($this->request->isGet()) {
				
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
					$data = $transaction->search($searchData, $paginationSetup);
					
				}
				else {
					
					//display default all transactions with attributes from pagination
					$data = $transaction->getTransactionData($paginationSetup);
				}
				
				$view->set('Transactions/admin_search', $data, $layout);
		
			}
			elseif ($this->request->isPost()) {
				
				$searchData = $this->request->getPostData();
				
				$paginationSetup = $pagination->setPaginationAttributes();
				$data = $transaction->search($searchData, $paginationSetup);
				
				//if data is not empy client matched - search transaction, 
				//otherwise display warning
				
				if ($data) {
					
					$view->set('Transactions/admin_search', $data, $layout);
					
				}
				else {
					$data = -1;
					$view->set('Transactions/admin_search', $data, $layout);
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
			
			$layout = parent::isGrant();
			
			$view = new View();
			$transaction = new TransactionModel();
			
				
			if ($this->request->isGet()) {
		
				$transactionId = $this->request->getParameters();
				//var_dump($transactionId[0]);
				$transactionData= $transaction->getTransaction($transactionId[0]);
				$view->set('Transactions/deleteConfirmation', $transactionData, $layout);
				
			}
			elseif ($this->request->isPost()) {
				
				$transactionId = $this->request->getPostData();
				
				//var_dump($transactionId['transactionId']);
				
				$transactionData = $transaction->deleteTransaction($transactionId['transactionId']);
				$view->set('Transactions/admin_deleteConfirmation', $transactionData, $layout);
			}
				
			$view->render();
				
		
		}
		catch (Exception $e) {
			echo "caugh Exception: ", $e->getMessage();
		}
	}
	
	
	
	/**
	 * 
	 * @param unknown $result
	 * show duplicate entry and wait for user move - add the same or cancel
	 */
	public function duplicateEntry($result) {
		
		try {
			
			$layout = parent::isSupervisor();
			$view = new View();
			
			if ($result[0] == 'transaction exist') {
					
				$view->set('Transactions/duplicateEntry', $result, $layout);
			}
			else {
					throw new Exception("problem during choose add or cancel duplicate entry");
				}
			
		}
		catch (Exception $e) {
			echo "caugh Exception: ", $e->getMessage();
			//var_dump($e->getTrace());
		}
		$view->render();
	}
	
	
	
	/**
	 * confirm added duplicate entry
	 * 
	 */
	public function confirmationDuplicate() {
		
		try {
			
			if ($this->request->isPost()) {
					
				$layout = parent::isSupervisor();
				$view = new View();
				$duplicate = new TransactionModel();
					
				$postData = $this->request->getPostData();
				
				if ($postData['ack'] == 'acknowledge') {
						
					$addDuplicate = $duplicate->addDuplicateTransaction($postData);
					
					if ($addDuplicate) {
			
						$view->set('Transactions/confirmationDuplicate', $addDuplicate, $layout);
						$view->render();
					}
				}
			}	
		}
		catch (Exception $e) {
			echo "caugh Exception: ", $e->getMessage();
		}
	}
	
	
	/**
	 * 
	 */
	public function endEarlier() {
		try {
			
			if ($this->request->isPost()) {
					
				$layout = parent::isSupervisor();
				
				$view = new View();
				$finishPayment = new TransactionModel();
				$postData = $this->request->getPostData();
				//var_dump($postData);
				$clientProduct = $finishPayment->endEarlier($postData);
				//var_dump($clientProduct);
				$view->set('Transactions/endEarlier', $clientProduct, $layout);
				$view->render();
			}
					
		}
		catch (Exception $e) {
			echo "caugh Exception: ", $e->getMessage();
		}
	}
	
}