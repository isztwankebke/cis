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
		
		$layout = parent::isGrant();
		
		$product = new ProductModel();
		$product->getProduct($parameters);
		$data = $product->getProductData();
		$view = new View();
		$view->set('/products/getProduct', $data, $layout);
		$view->render();
	}
	
	
	
	/**
	 * 
	 */
	public function admin_read() {
		try {
			
			$layout = parent::isGrant();
			
			$view = new View();
			
			
			if ($this->request->isGet()) {
				//$this->autoRender = false;
				$product = new ProductModel();
			
				$products = $product->admin_read();
				$view->set('Products/admin_index', $products, $layout);
					
			}
			elseif ($this->request->isPost()) {
				$this->admin_addProduct();
			}
			
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage(); 
		}
		
	}
	
	
	
	/**
	 * 
	 */
	public function admin_addProduct() {
		try {
			
			$layout = parent::isGrant();
			
			$view = new View();
			if ($this->request->isGet()) {
				
				$view->set('Products/admin_addProduct', null, $layout);
			}
			elseif ($this->request->isPost()) {
			
				$product = new ProductModel();
				$productData = $this->request->getPostData();
				$result = $product->addProduct($productData);
				$view->set('Products/confirmation', $result, $layout);
				
			}
			
			$view->render();
		}
		catch (Exception $e) {
			echo "Caught exception: ", $e->getMessage();
		}
		
		
	}
	
	
	
	
	/**
	 * EDIT PRODUCT
	 * @param unknown $parameters
	 */
	public function admin_editProduct() {
		try {
			
			$layout = parent::isGrant();
			
			$view = new View();
			$product = new ProductModel();
			
			if ($this->request->isGet()) {
				
				$parameters = $this->request->getParameters();
				$result = $product->getProduct($parameters);
					
				if (debug) {
					var_dump($parameters);
					var_dump($result);
				}	
				
				$view->set('Products/admin_editProduct', $result, $layout);
				
			}
			else if ($this->request->isPost()) {
				$parameters = $this->request->getPostData();
				$result = $product->editProduct($parameters);
				$view->set('Products/confirmation', $result, $layout);
			}
			
			$view->render();
			
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	
	
}

