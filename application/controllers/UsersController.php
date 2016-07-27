<?php
//to robi akcja
//1.pobrac dane
//2.zweryfikowac czy sa prawidlowa
//3.wykonac odpowiednia akcje
//4 zwrocic do widoku albo wyrenderowac widok

//jak bedzie blad

class UsersController extends Controller {
	
	/**
	 * 
	 * @param Request $request
	 */
	function __construct(Request $request) {
		
		parent::__construct($request);
		
	}
	
	
	
	/**
	 * 
	 */public function test($parameters) {
		
		$this->session->read('User');
		if ($this->request->isGet()) {
			// wylistuj cos
		}
		else if ($this->request->isPost()) {
			// czyzby dane z formularza ?
		}
		else {
			// nie obslugujemy innych zapytan typu PUT, DELETE.
		}
		//$parameters = implode(", ", $parameters);
		echo "<br>Dane klienta do dodania:<br>";
		var_dump($parameters);
	}
	
	
	
	/**
	 * ADD PRODUCT
	 * @param unknown $parameters
	 */
	public function addProduct($ofe, $zus, $param = 'SLD') {
		try {
			if ($this->request->isGet()) {
				// render create form
				echo "renderuję piękną tablekę ;)";
				echo "OFE: {$ofe}; ZUS: {$zus}, dodatek: {$param}";
				
				// to be continued...
				// $this->render('defaultLayout', 'path/to/addProduct/view', $params);
			}
			else if ($this->request->isPost()) {
				
				// save new product
				$product = new ProductModel();
				$product->addProduct($this->request->getParameters('post'));
				var_dump($product->getProductData());
				
				// redirect to index action, show updated list of products
			}
			
		}
		catch (Exception $e) {
			echo "caugh exxception: ", $e->getMessage();
		}
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
	
	
	
	/**
	 * GET PRODUCT
	 * @param unknown $parameters
	 */
	public function getProduct($parameters) {
		$product = new ProductModel();
		$product->getProduct($parameters);
		return $product->getProductData();
	}
	
	
	
	/**
	 * EDIT PRODUCT
	 * @param unknown $parameters
	 */
	public function editProduct($parameters) {
		try {
			$product = new ProductModel();
			$product->editProduct($parameters);
			var_dump($product->getProductData());
				
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	
	public function addAlertRule($parameters) {
		try {
			
			$alert = new AlertModel();
			
			
		}
		catch (Exception $e) {
			echo "caugh Exception: ", $e->getMessage();
		}
	}
	
	
	/**
	 * print echo echo on screen
	 * @param unknown $parameters
	 */
	public function printName($parameters) {
		var_dump($parameters);
		
		var_dump($parameters['imie']);
		
	}
	
}