<?php
class DashboardsController extends Controller {



	/**
	 *
	 * @param Request $request
	 */
	function __construct(Request $request) {

		parent::__construct($request);

	}
	
	
	
	public function addAlertRule($parameters) {
		try {
				
			$alert = new DashboardModel();
				
				
		}
		catch (Exception $e) {
			echo "caugh Exception: ", $e->getMessage();
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
	public function read() {
		$alert = new DashboardModel();
		$alerts = $alert->read();
		
		$view = new View();
		if ($_SESSION['grant'] == 1) {
			$view->set('Dashboards/read', $alerts, 'admin');
		}
		else {
			$view->set('Users/admin_fault');
		}
		
		$view->render();
	}
	
	
	
	
	
	
	
	
	
	
}