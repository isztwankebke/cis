<?php
class Controller {
	
	
	/**
	 * 
	 * @var Request
	 */
	protected $request = null;
	
	
	protected $session = null;
	//protected $view = null;
	
	protected $autoRender = true;
	
	/**
	 * 
	 * @param Request $request
	 */
	public function __construct(Request $request) {
		
		$this->request = $request;
	}
	
	/*
	public function render() {
		
		if ($this->autoRender) {
			include View::getPath;
			
			// renderuj widok
			
		}
	}*/
	
	
	
	
		
	
}