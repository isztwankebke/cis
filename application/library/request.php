<?php

//model/action/parameter/value

/**
 *
* SuperController in library directory; Give decoded url divided by:
* ControllerName
* ActionName
* ParameterName
*
*
*/
class Request {

	protected  $url;
	protected $requestMethod;
	
	private $requestedControllerName = null;
	private $requestedActionName = null;
	private $params = ['get' => [], 'post' => []];

	public function __construct($data) {
		
		//get url data from REQUEST_URI; there always will be= / if empty or / controller/action/param1/...paramN
		
		$this->url = $_SERVER['REQUEST_URI'];
		$this->requestMethod = $_SERVER['REQUEST_METHOD'];
		
		
		$this->decodeURL2();
		
	}
	
	
	private function decodeURL2() {
		
		$explodedURL = explode('/', $this->url);
		array_shift($explodedURL);
		
		if (count($explodedURL)) {
			if (isset($explodedURL[0])) {
				$this->requestedControllerName = "{$explodedURL[0]}Controller";
			}
			if (isset($explodedURL[1])) {
				$this->requestedActionName = $explodedURL[1];
			}
			
			if (count($explodedURL) > 2) {
				$this->params['get'] = array_slice($explodedURL, 2);
			}
		}
		
	}
	
	

	
	
	/**
	 * get controller name
	 * @return string, null
	 */
	public function getControllerName () {
		
		return $this->requestedControllerName;
		
	}
	
	
	
	/**
	 * get action name
	 */
	public function getActionName() {
		
		return $this->requestedActionName;
		
	}
	
	
	
	/**
	 * @param $foo string representing a value 
	 * get parameters
	 * @return array or null if no parameters delivered
	 */
	public function getParameters($type = 'get') {

		return $this->params[$type];
	}

	
	
	/**
	 * check is post
	 */
	public function isPost () {

		if ($this->requestMethod === 'POST') {
				
			return true;
		}
		else{
			return null;
		}
	}
	
	
	
	/**
	 * check is get
	 */
	public function isGet() {
		
		if ($this->requestMethod === 'GET') {
				
			return true;
		}
		else {
			return null;
		}

	}
	
}
	
	
	
		
	
	
	










			

