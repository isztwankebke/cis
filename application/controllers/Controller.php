<?php
class Controller {
	
	
	/**
	 * 
	 * @var Request
	 */
	protected $request = null;
	
	
	protected $session = null;
	
	/**
	 * 
	 * @param Request $request
	 */
	function __construct(Request $request) {
		
		$this->request = $request;
	}
	
	
	
	
		
	
}