<?php
class ReportsController extends Controller {

	/**
	 *
	 * @param Request $request
	 */
	function __construct(Request $request) {

		parent::__construct($request);

	}
	
	
	
	/**
	 * 
	 */
	public function index() {
		
		$view = new View();
		$view->set('Reports/index');
		$view->render();
	}
	
	
	
}