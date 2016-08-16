<?php
include_once 'DataModel.php';
class ProductModel  extends Model{
	
	private $productData;
	private $productName;
	private $productId;
	
	
	
	/**
	 * 
	 */
	public function __construct($id = null) {
		
		parent::__construct($id);
		
	}
	
	//readProduct
	//check recived Data
	//check product exist
	//add product
	//edit Product
	
	
	
	/**
	 * 
	 * @param unknown $productId
	 */
	private function setProdductId ($productId) {
		$this->productId = $productId;
		return $this;
	}
	
	
	
	/**
	 * 
	 * @param unknown $productName
	 */
	private function setProductName ($productName) {
		$this->productName = $productName;
		return $this;
	}
	
	
	
	/**
	 * 
	 */
	private function setProductData() {
		$this->productData = array(
				"id"			=> $this->getProductId(),
				"product_name" 	=> $this->getProductName()
		);
		return $this;
		
	}
	
	
	
	/**
	 * 
	 */
	public function getProductId() {
		return $this->productId;
	}
	
	
	
	/**
	 * 
	 * @return unknown
	 */
	private function getProductName() {
		return $this->productName;
	}
	
	
	
	/**
	 * 
	 */
	public function getProductData() {
		return $this->productData;
	}
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @throws Exception
	 */
	public function getProduct ($parameters) {
		
		$dataToCheck = ['productName'];
		
		$checkData = new DataModel();
		
		$validateData = $checkData->validateRecivedData($dataToCheck, $parameters);
		
		if ($validateData) {
			
			//variable with product name to check is exist in db
			$productName = $parameters['productName'];
			
			$productId = $this->isProductExist($productName, $id = null);
			
			if ($productId) {
				
				return true;
			}
			else {
				//throw new Exception("Product not Exist");
				
				return false;
			}
		}
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $productName
	 */
	public function isProductExist ($productName, $id) {
		
		$sql = "SELECT * 
				FROM 
				`products` 
				WHERE `product_name` = '{$productName}' OR `id` = '{$id}'";
		
		$result = parent::query($sql);
		
		if (!$result) {
			return false;
		}
		
		$productId = $result[0]['id'];
		$productName = $result[0]['product_name'];
		
		//setting product id and name
		$this->setProdductId($productId);
		$this->setProductName($productName);
		$this->setProductData();
		
		return true;
		
		
	}
	
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @throws Exception
	 */
	public function addProduct($parameters) {
		
		$dataToCheck = ['productName'];
		
		$checkData = new DataModel();
		
		$validateData = $checkData->validateRecivedData($dataToCheck, $parameters);
		
		if ($validateData) {
			
			//variable with product name to check is exist in db
			$productName = $parameters['productName'];
				
			$productExist = $this->isProductExist($productName, $id = null);
				
			if ($productExist) {
		
				throw new Exception("product already exist");
				return false;
			}
			
			$this->setProductName($productName);
			
			$sql = "INSERT
			INTO `products`
			(`product_name`)
			VALUES ('{$this->getProductName()}')";
			
			$result = parent::query($sql);
			
			if (empty($result)) {
					
				return false;
			}
			//setting product id
			$productId = $this->insert_id;
			$this->setProdductId($productId);
			
			//setting product data
			
			$this->setProductData();
			
			return true;
		}
	}
	
	
	
	
	/**
	 * 
	 * @param unknown $parameters
	 * @throws Exception
	 * @return unknown[]
	 */
	public function editProduct($parameters) {
		//validate recived data
		$dataToCheck = [
		'productID',
		'productName'
		];
		
		$dataModel = new DataModel();
		$validateData = $dataModel->validateRecivedData($dataToCheck, $parameters);
		
		if ($validateData) {
			
			$productId = $parameters['productID'];
			
			$productExist = $this->isProductExist($productName = null, $productId);
			
			$productName = $parameters['productName'];
			
			if ($productExist) {
				
				$oldProductName = $this->getProductName();
				
				if ($productName == $oldProductName) {
					throw new Exception("Nothing change - product name the same");
					return false;
				}
				
				$this->setProductName($productName);
				
				$sql = "UPDATE
					`products`
					SET
					`product_name`='{$this->getProductName()}' WHERE `id`='{$this->getProductId()}'";
				
				$result = parent::query($sql);
				
				if (empty($this->affected_rows)) {
					throw new Exception("erroraaaaa during update db");
				}
				
				$this->setProductData();
				
				return true;
				
			}
			throw new Exception('Product not found');
		}
		
		
	}
	
	
	
	/**
	 * 
	 */
	public function read() {
		$sql = "SELECT *
				FROM `products`
				WHERE 1";
		
		$result = parent::query($sql);
		
		return $result;
		
		
	}
	
	
	
		
}