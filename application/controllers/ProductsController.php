<?php
class ProductsController extends Controller {

	/**
	 *
	 * @param Request $request
	 */
	function __construct(Request $request) {

		parent::__construct($request);

	}
	
	
	
	/**
	 * ADD PRODUCT
	 * @param unknown $parameters
	 */
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
	
	
	
	
	
}

