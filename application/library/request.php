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
		$controllerName = $this->DecodeURL("controller");
		
		if ($controllerName != null) {
			
			return $controllerName;
		}
		else {
			throw new Exception("no controller name");
		}
		
	}
	
	
	
	/**
	 * get action name
	 */
	public function getActionName() {
		
		return $this->requestedActionName;
		$actionName = $this->DecodeURL("action");
		
		if ($actionName != null) {
			
			return $actionName;
		}
		//echo "12345";
		
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
	
	
	
	/**
	 * method give a ['controller','action',and parameters]
	 * @throws Exception
	 * @return boolean|mixed|string
	 */
	public function DecodeURL($name){
		
		try {
		
			$requestUri = null;
			
			/*check is REQUEST_URI exist*/
			if ($this->isUriDataExist($this->url, "url")) {
				
				$requestUri = $this->url;
			}
			
			
			/*remove / (slash) from end of path*/
			$requestUri = trim($requestUri, '/'); 
			
			/*path is empty*/
			if (empty($requestUri)) { 
				
				return null;
			}
			
			/*divide path via / (slash)*/
			$uriArray = explode('/',$requestUri);
			
			/*check how many elements is in array*/
			$countUriArray = count($uriArray);
			
			
			/*at this checkpoint is at least 1 element - it`s ControllerName*/
			if ($name == "controller") {
				
				if ($this->isUriDataExist($uriArray[0], $name)) {
					
					$controllerName = $uriArray[0];
					return $controllerName;
				}
				
			}
			
			/*second element in uri is action name, check is exist and return value*/
			elseif ($name == "action") {
				
				$uriArray[1] = isset($uriArray[1]) ? $uriArray[1] : null; //if some not set action
				
				
				if ($this->isUriDataExist($uriArray[1], $name)) {
					
					$actionName = $uriArray[1];
					return $actionName;
				}
			}
			
			/*next are parameter name and parameter value and they change for 2*/
			
			elseif ($name == "parameters") {
				
				if ($countUriArray > 2) {
					
					$j = 0;
					for ($i = 2; $i < $countUriArray; $i += 2) {
					
						$parameterName[$j] = isset($uriArray[$i]) ? $uriArray[$i] : null; //parameter name
						$parameterValue[$j] = isset($uriArray[$i+1]) ? $uriArray[$i+1] : null; //parameter value
						//$parameter[$parameterName] = $parameterValue;
						$j++;
						
					}
					
					/*check is each parameters name has a value*/
					if (!in_array(null, $parameterValue, true) && !in_array(null, $parameterName, true)) {
						$parameters = array_combine($parameterName, $parameterValue);
						return $parameters;
					}
					else {
						throw new Exception("no Valid Parameters");
						return null;
					}
					
				}
				return null;
				
			}
		}
	
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			die;
		}
	}
	
	
	
	/**
	 * 
	 * @param unknown $uriArrayElement
	 * @param unknown $dataName
	 * @throws Exception
	 */
	private function isUriDataExist ($uriArrayElement, $dataName) {
		
		if ($uriArrayElement === null) {
			
			throw new Exception("name or value in address is incorrect");
			return null;
		}
		else {
			return true;
		}
		
	}
	
	










			}

