<?php
class TransactionsController extends Controller {



	/**
	 *
	 * @param Request $request
	 */
	function __construct(Request $request) {

		parent::__construct($request);

	}
	
	
	
	public function addAlertRule($parameters) {
		try {
				
			$alert = new AlertModel();
				
				
		}
		catch (Exception $e) {
			echo "caugh Exception: ", $e->getMessage();
		}
	}
	
	
	
	
	
	
	
}