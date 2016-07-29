<?php
include_once 'DataModel.php';

class TransactionModel extends Model {
	
	private $transactionData;
	private $clientID;
	private $productID;
	private $initialDate;
	private $endDate;
	private $period;
	private $transactionID;
	
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct();
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $transactionID
	 */
	private function setTranasactionID($transactionID) {
		$this->transactionID = $transactionID;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $clientID
	 * @return TransactionModel
	 */
	private function setClientID($clientID) {
		$this->clientID = $clientID;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $productID
	 */
	private function setProductID($productID) {
		$this->productID = $productID;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $initialDate
	 */
	private function setInitialDate($initialDate) {
		$this->initialDate = $initialDate;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $endDate
	 * @return TransactionModel
	 */
	private function setEndDate($endDate) {
		$this->endDate = $endDate;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $period
	 */
	private function setPeriod($period) {
		$this->period = $period;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @return unknown
	 */
	private function getClientID() {
		return $this->clientID;
	}
	
	
	
	/**
	 * 
	 * @return unknown
	 */
	private function getProductID() {
		return $this->productID;
	}
	
	
	
	/**
	 * 
	 */
	private function getInitialDate() {
		return $this->initialDate;
	}
	
	
	
	/**
	 * 
	 */
	private function getEndDate() {
		return $this->endDate;
	}
	
	
	
	/**
	 * 
	 */
	private function getPeriod() {
		return $this->period;
	}
	
	
	
	/**
	 * 
	 */
	private function getTransactionID() {
		return $this->transactionID;
	}
	
	
	
	/**
	 * 
	 * @return TransactionModel
	 */
	private function setTransactionData() {
		$this->transactionData = array(
				"id" 			=> $this->getTransactionID(),
				"client_id" 	=> $this->getClientID(),
				"product_id" 	=> $this->getProductID(),
				"init_date" 	=> $this->getInitialDate(),
				"period" 		=> $this->getPeriod(),
				"end_date" 		=> $this->getEndDate()
		);
		
		return $this;
	}
	
	
	
	/**
	 * 
	 */
	public function getTransactionData() {
		
		return $this->transactionData;
	}
	
	
	
	/**
	 * 
	 * @param unknown $clientID
	 * @param unknown $productID
	 * @param unknown $parameters
	 * @throws Exception
	 */
	public function addTransaction($clientData, $productData, $parameters) {
		
		$transactionParameters = $this->getTransactionParameters($parameters);
		
		if (!$transactionParameters) {
			throw new Exception("wrong parameters");
			return false;
		}
		
		$clientID = $clientData['id'];
		$productID = $productData['id'];
		
		$this->setClientID($clientID);
		$this->setProductID($productID);
		
		$sql = "INSERT 
		INTO `transactions`
		(`client_id`, `product_id`, `init_date`, `period`, `end_date`) 
		VALUES 
		('{$this->getClientID()}', '{$this->getProductID()}', '{$this->getInitialDate()}', '{$this->getPeriod()}', '{$this->getEndDate()}')";
		
		$result = parent::query($sql);
		
		if (empty($result)) {
			throw new Exception("can not add transaction to db");
			return false;
			
		}
		$transactionID = $this->insert_id;
		$this->setTranasactionID($transactionID);
		$this->setTransactionData();
		
		return true;
			
	}
	
	
	
	/**
	 * 
	 * @param unknown $transactionID
	 * @throws Exception
	 * @return boolean
	 */
	public function isTransactionExist($transactionID) {
		
		$sql = "SELECT * 
				FROM `transactions` 
				WHERE 
				`id` = '{$transactionID}'
				LIMIT 1";
		
		$result = parent::query($sql);
		
		if (empty($result)) {
			throw new Exception("wrong parameters to edit");
			return false;
				
		}
		$clientID = $result[0]['client_id'];
		$initialDate = $result[0]['init_date'];
		$period = $result[0]['period'];
		$productID = $result[0]['product_id'];
		$this->setTranasactionID($transactionID);
		$this->setInitialDate($initialDate);
		$this->setPeriod($period);
		$this->setClientID($clientID);
		$this->setProductID($productID);
		
		return true;
	}
	
	
	
	/**
	 * 
	 * @param unknown $clientData
	 * @param unknown $productData
	 * @param unknown $parameters
	 * @throws Exception
	 */
	public function edtitTransaction($parameters) {
		//we can edit: initialDate, period and taken product, if client is different it nesesary to remove transaction and
		//add new one
		//we must check parameters first
		$dataToCheck = [
				'clientID',
				'productName',
				'transactionID',
				'initialDate',
				'period'
		];
		
		$dataModel = new DataModel();
		$validateData = $dataModel->validateRecivedData($dataToCheck, $parameters);
		if ($validateData) {
			
			$transactionID = $parameters['transactionID'];
			$transactionExist = $this->isTransactionExist($transactionID);
			
			if ($transactionExist) {
				$oldInitialDate = $this->getInitialDate();
				$oldPeriod = $this->getPeriod();
				$oldProductId = $this->getProductID();
				
				$initialDate = $parameters['initialDate'];
				$period = $parameters['period'];
				
				//check if new product name exist
				$productName = $parameters['productName'];
				$product = new ProductModel();
				$productExist = $product->isProductExist($productName, $id = null);
				if (!$productExist) {
					throw new Exception("no valid product");
					return false;
				}
				$productID = $product->getProductId();
				
				var_dump($oldInitialDate);
				var_dump($initialDate);
				var_dump($oldPeriod);
				var_dump($period);
				var_dump($oldProductId);
				var_dump($productID);
				
				
				//check is data were changed
				if ($oldInitialDate == $initialDate && $oldPeriod == $period && $oldProductId == $productID) {
						throw new Exception("no data to change in transaction");
						return false;
					}
				$this->endDate($initialDate, $period);
				$this->setInitialDate($initialDate);
				$this->setPeriod($period);
				$this->setProductID($productID);
				$this->setTransactionData();
				
				$sql = "UPDATE
						`transactions`
						SET
						`product_id`= '{$this->getProductID()}',
						`init_date`='{$this->getInitialDate()}',
						`period`='{$this->getPeriod()}',
						`end_date`='{$this->endDate}' 
						WHERE 
						`id` ='{$this->getTransactionID()}'";
				
				$result = parent::query($sql);
				
				if (empty($this->affected_rows)) {
					throw new Exception("can not add transaction to db");
					return false;
				
				}
				return true;
				
			}
		}
			
	}
	
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @return boolean
	 */
	public function getTransactionParameters ($parameters) {
		
		$dataToCheck = [
				'initialDate',
				'preiod'
			];
		$checkData = new DataModel();
		
		$dataValidate = $checkData->validateRecivedData($dataToCheck, $parameters);
		
		if ($dataValidate) {
			
			$initialDate = $parameters['initialDate'];
			$period = $parameters['period'];
			
			if ($this->validateDate($initialDate) && $this->vaidatePeriod($period)) {
				
				$this->setInitialDate($initialDate);
				$this->setPeriod($period);
				
				$this->endDate($this->getInitialDate(), $this->getPeriod());
				
				return true;
			}
			
			else {
				return false;
			}
		}
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $date
	 * @throws Exception
	 */
	public function validateDate ($date) {
		
		
		$today = date('Y-m-d', time());
		
		if (preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date)) {
			
			if (strtotime($today) >= strtotime($date)) {
				return true;
			}
			else {
				throw new Exception("initial date can not be in future");
				return false;
			}
			
		}
		throw new Exception("recived date format is incorrect");
		return false;
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $period
	 * @throws Exception
	 */
	public function vaidatePeriod ($period) {
		
		if (is_numeric($period)) {
			return true;
		}
		
		else {
			throw new Exception("not valid period value");
			return false;
		}
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $initialDate
	 * @param unknown $period
	 */
	public function endDate ($initialDate, $period) {
	
		
		$endDate = date('Y-m-d', strtotime($initialDate. " + $period month"));
		$this->setEndDate($endDate);
		return true;
	
	}
	
	
}