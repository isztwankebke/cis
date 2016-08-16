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
		$view = new View();
		$view->set('Dashboards/index');
		$view->render();
	}
	
	public function read() {
		$alert = new DashboardModel();
		$alerts = $alert->read();
		
		$view = new View();
		$view->set('Dashboards/read', $alerts, 'admin');
		$view->render();
	}
	
	
	
	
	
	
}