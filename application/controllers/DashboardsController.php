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
			$layout = parent::isGrant();
		
			$view = new View();
			$alert = new DashboardModel();
			$product = new ProductModel();
			
			if ($this->request->isGet()) {
					
				$products = $product->admin_read();
				$view->set('Dashboards/admin_addAlert', $products, $layout);
					
					
			}
			elseif ($this->request->isPost()) {
					
				$alertData = $this->request->getPostData();
				$result = $alert->addAlert($alertData);
				$view->set('Dashboards/confirmation', $result, $layout);
					
			}
			
			$view->render();
			
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	/**
	 * display list of transcations which were set on admin alerts mode
	 */
	public function index() {
		
		$layouts = parent::isSupervisor();
		
		$dashboard = new DashboardModel();
		$alerts = $dashboard->index();
		$view = new View();
		$view->set('Dashboards/index', $alerts, $layouts);
		$view->render();
	}
	
	
	
	/**
	 * 
	 */
	public function admin_read() {
		
		try {
			
			$layout = parent::isGrant();
			
			$alert = new DashboardModel();
			$alerts = $alert->admin_read();
			
			$view = new View();
			
			$view->set('Dashboards/admin_read', $alerts, $layout);
			
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception:", $e->getMessage();
		}
		
	}
	
	
	
	/**
	 * 
	 */
	public function admin_deleteAlert() {
		
		try {
			
			$layout = parent::isGrant();
			
			$view = new View();
			$product = new ProductModel();
			$alert = new DashboardModel();
			
			if ($this->request->isGet()) {
		
				$parameters = $this->request->getParameters();
				//var_dump($parameters);
				$alertData = $alert->getAlert($parameters);
				$view->set('Dashboards/admin_deleteAlert', $alertData, $layout);
			}
				
			elseif ($this->request->isPost()) {
					
				$parameters = $this->request->getPostData();
				//var_dump($parameters);
				$result = $alert->deleteAlert($parameters);
				$view->set('Dashboards/delete_confirmation', $result, $layout);
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
	public function admin_editAlert() {
		
		try {
			
			$layout = parent::isGrant();
			
			$view = new View();
			$alert = new DashboardModel();
		
			if ($this->request->isGet()) {
		
				$parameters = $this->request->getParameters();
				$alertData = $alert->getAlert($parameters);
				$view->set('Dashboards/admin_editAlert', $alertData, $layout);
			}
		
			elseif ($this->request->isPost()) {
					
				$parameters = $this->request->getPostData();
				$result = $alert->editAlert($parameters);
				$view->set('Dashboards/confirmation', $result, $layout);
			}
		
			$view->render();
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	/**
	 * returns array with entries added to db in specified day
	 */
	public function todayEntry() {
		
		try {
			
			$view = new View();
			$layout = parent::isSupervisor();
			$entries = new DashboardModel();
			
			if ($this->request->isGet()) {
				
				$todayEntries = $entries->todayEntry();
				
			}
			elseif ($this->request->isPost()) {
				
				$postData = $this->request->getPostData();
				//var_dump($postData);
				$todayEntries = $entries->todayEntry($postData['day']);
				
			}
			
			$view->set('Dashboards/todayEntry', $todayEntries, $layout);
			$view->render();
			
			
		}
		catch (Exception $e) {
			echo "Exception: ", $e->getMessage();
		}
	}
	
	
	
	
	
	
}