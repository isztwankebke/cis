<?php
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
	 * return list of products
	 */
	public function admin_read() {
		$sql = "SELECT *
				FROM `products`
				WHERE 1";
	
		$result = parent::query($sql);
	
		return $result;
	
	
	}
	
	
	
	/**
	 * 
	 * @return boolean
	 * the same as admin_read - temporary for use to addTransaction
	 */
	public function productRead() {
		$sql = "SELECT *
				FROM `products`
				WHERE 1";
		
		$result = parent::query($sql);
		
		return $result;
		
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
	public function getProduct($parameters) {
		
		$sql = "SELECT
				* 
				FROM 
				products 
				WHERE 
				id = '{$parameters[0]}' ";
		
		$result = parent::query($sql);
		if (!$result) {
			return false;
		}
		return $result;
		
	}
	
	
	
	/**
	 * 
	 * @param $productName or $id
	 * return true  if product exist or false if product not exist
	 */
	public function isProductExist ($productName, $id) {
		
		$sql = "SELECT 
				* 
				FROM 
				products 
				WHERE 
				products.product_name = '{$productName}' OR `id` = '{$id}'";
		
		$result = parent::query($sql);
		
		if (!$result) {
			return false;
		}
		
		//setting product id and name
		$this->productName = parent::setFirstLetterUppercase($result[0]['product_name']);
		$this->productId = $result[0]['id'];
		
		
		return true;
		
	}
	
	
	
	/**
	 * 
	 * @param $productData
	 * @throws Exception
	 */
	public function addProduct($productData) {
		
		
		//first check recived data: is not empty
		//is valid name
		//is product exist
		//if everything above is ok
		//add product to db
		//return true
		if (!$this->checkProductData($productData)) {
			return false;
		}
		$productName = parent::setFirstLetterUppercase($productData['product_name']);
		
		if ($this->isProductExist($productName, null)) {
			
			throw new Exception('Product already exist, change name of given Product Name');
			return false;
		}
		
		$sql = "INSERT
				INTO 
				products
		(`product_name`)
		VALUES ('{$productName}')";
			
		$result = parent::query($sql);
			
		if (empty($result)) {
					
			return false;
		}
			
		$productId = $this->insert_id;
		
		return true;
		
	}
	
	
	
	
	/**
	 * 
	 * @param $parameters
	 * @throws Exception
	 * @return false if something wrong or true if update is ok
	 */
	public function editProduct($parameters) {
		//validate recived data
		if (!$this->checkProductData($parameters)) {
			return false;
		}
		$productName = parent::setFirstLetterUppercase($parameters['product_name']);
		
		if ($this->isProductExist($productName, null)) {
			throw new Exception('Product already exist, change name of given Product Name');
			return false;
		}
		
		$sql = "UPDATE
				products
				SET
				products.product_name='{$productName}' 
				WHERE 
				products.id='{$parameters['id']}'";
				
		$result = parent::query($sql);
				
		if (empty($this->affected_rows)) {
			
			throw new Exception("erroraaaaa during update db");
			return false;
		}
		
		return $result;
			
	}
	
	
	
	/**
	 * 
	 * @param $productData
	 * @throws Exception
	 * return true if everything is ok with sended data via POST
	 * else return false
	 */
	public function checkProductData($productData) {
		
		//check is input is not empty
		if (!isset($productData['product_name'])) {
			
			throw new Exception("Product Value not valid");
			return false;
		}
		
		//check is input value is alphanumeric
		if (!preg_match('/[A-ZŹŻŁa-zęółśążźćń ]$/', $productData['product_name'])) {
			
			throw new Exception('Product Name is not in valid format (only alphanumeric signs)');
			return false;
			
		}
		
		return true;
		
		
	}
	
	
	
	
	
	
		
}