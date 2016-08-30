<?php
class ProductsController extends Controller {

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
	 * ADD PRODUCT
	 * @param unknown $parameters
	 *
	public function addProduct($parameters) {
		try {
			$product = new ProductModel();
			$product->addProduct($parameters);
			var_dump($product->getProductData());
				
		}
		catch (Exception $e) {
			echo "caugh exxception: ", $e->getMessage();
		}
	}
	*/

	
	
	
	/**
	 * GET PRODUCT
	 * @param unknown $parameters
	 */
	public function getProduct($parameters) {
		$product = new ProductModel();
		$product->getProduct($parameters);
		$data = $product->getProductData();
		$view = new View();
		$view->set('/products/getProduct', $data, 'admin');
		$view->render();
	}
	
	
	
	/**
	 * 
	 */
	public function admin_read() {
		
		$view = new View();
		
		
		if ($this->request->isGet()) {
			//$this->autoRender = false;
			$product = new ProductModel();
				
			$products = $product->admin_read();
			
			
			if ($_SESSION['grant'] == 1) {
				
				$view->set('Products/admin_index', $products, 'admin');
			}
			else {
				$view->set('Users/admin_fault');
			}
			
		}
		elseif ($this->request->isPost()) {
			$this->admin_addProduct();
		}
		
		$view->render();
	}
	
	
	
	/**
	 * 
	 */
	public function admin_addProduct() {
		try {
			$view = new View();
			if ($this->request->isGet()) {
				
				$view->set('Products/admin_addProduct', null, 'admin');
			}
			elseif ($this->request->isPost()) {
			
				$product = new ProductModel();
				$productData = $this->request->getPostData();
				$result = $product->addProduct($productData);
				$view->set('Products/confirmation', $result, 'admin');
				
			}
		}
		catch (Exception $e) {
			echo "Caught exception: ", $e->getMessage();
		}
		$view->render();
		
	}
	
	
	
	
	/**
	 * EDIT PRODUCT
	 * @param unknown $parameters
	 */
	public function admin_editProduct() {
		try {
			
			$view = new View();
			$product = new ProductModel();
			
			if ($this->request->isGet()) {
				
				$parameters = $this->request->getParameters();
				$result = $product->getProduct($parameters);
					
				if (debug) {
					var_dump($parameters);
					var_dump($result);
				}	
				
				$view->set('Products/admin_editProduct', $result, 'admin');
				
			}
			else if ($this->request->isPost()) {
				$parameters = $this->request->getPostData();
				$result = $product->editProduct($parameters);
				$view->set('Products/confirmation', $result, 'admin');
			}
			
			$view->render();
			
			
			
			
			/*
			if ($this->request->isPost()) {
				$this->admin_addProduct();
			}
	*/
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	
	
}

