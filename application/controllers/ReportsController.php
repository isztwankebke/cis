<?php
class ReportsController extends Controller {

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
	public function index() {
		
		$layout = parent::isSupervisor();
		
		$view = new View();
		$view->set('Reports/index', null, $layout);
		$view->render();
	}
	
	
	
}