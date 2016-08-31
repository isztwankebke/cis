<?php
class DashboardsController extends Controller {



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
	 */
	public function admin_addAlert() {
	try {
			$view = new View();
			$alert = new DashboardModel();
			$product = new ProductModel();
		
			if ($this->request->isGet()) {
				
				$products = $product->admin_read();
				$view->set('Dashboards/admin_addAlert', $products, 'admin');
				
				
			}
			elseif ($this->request->isPost()) {
				
				$alertData = $this->request->getPostData();
				$result = $alert->addAlert($alertData);
				$view->set('Dashboards/confirmation', $result, 'admin');
				
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
	public function index() {
		
		$dashboard = new DashboardModel();
		$alerts = $dashboard->index();
		$view = new View();
		$view->set('Dashboards/index', $alerts);
		$view->render();
	}
	
	
	
	/**
	 * 
	 */
	public function admin_read() {
		$alert = new DashboardModel();
		$alerts = $alert->admin_read();
		
		$view = new View();
		if ($_SESSION['grant'] == 1) {
			$view->set('Dashboards/admin_read', $alerts, 'admin');
		}
		else {
			$view->set('Users/admin_fault');
		}
		
		$view->render();
	}
	
	
	
	/**
	 * 
	 */
	public function admin_deleteAlert() {
		try {
				
			$view = new View();
			$product = new ProductModel();
			$alert = new DashboardModel();
			
			if ($this->request->isGet()) {
		
				$parameters = $this->request->getParameters();
				$productData = $product->getProduct($parameters);
				$view->set('Dashboards/admin_deleteAlert', $productData, 'admin');
			}
				
			elseif ($this->request->isPost()) {
					
				$parameters = $this->request->getPostData();
				$result = $alert->deleteAlert($parameters);
				$view->set('Dashboards/delete_confirmation', $result, 'admin');
			}
				
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	
	public function admin_editAlert() {
		try {
		
			$view = new View();
			$alert = new DashboardModel();
		
			if ($this->request->isGet()) {
		
				$parameters = $this->request->getParameters();
				$alertData = $alert->
				$view->set('Users/admin_editUser', $userData, 'admin');
			}
		
			elseif ($this->request->isPost()) {
					
				$parameters = $this->request->getPostData();
				$result = $user->editUser($parameters);
				$view->set('Users/confirmation', $result, 'admin');
			}
		
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	
	
	
	
	
}