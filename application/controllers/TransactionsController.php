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
	
	
}