<?php

//model/action/parameter/value

/**
 *
* class give address url
*
*/
class Request {

	private $url;
	//private $requestMethod;
	

	public function __construct($data) {
		$this->url = $_SERVER['REQUEST_URI'];
		//$this->requestMethod = $_SERVER['REQUEST_METHOD'];
		
		
	}



	/**
	 * get controller name
	 */
	public function getControllerName () {
		
		if ($extractUrl = $this->DecodeURL()[0]) {
			
			return $extractUrl;
		}
		return false;
	}
	
	/**
	 * get action name
	 */
	public function getActionName() {
		
		if ($extractUrl = $this->DecodeURL()[1]) {
			
			return $extractUrl;
		}
		return false;
	}
	
	/**
	 * get parameters
	 */
	public function getParameters() {
		
		if ($extractUrl = $this->DecodeURL()[2]) {
			
			return $extractUrl;
		}
		return false;
		
		
	}

	/**
	 * check is post
	 */
	public function isPost () {

		if ($this->requestMethod === 'POST') {
				
			return true;
		}
		else return false;
	}

	/**
	 * check is get
	 */
	public function isGet() {

		if ($this->requestMethod === 'GET') {
				
			return true;
		}
		else return false;

	}
	
	/**
	 * method give a ['controller','action',and parameters]
	 * @throws Exception
	 * @return boolean|mixed|string
	 */
	public function DecodeURL(){
		
		$requestUri = null;
		//var_dump($requestUri);
		if (!empty($_SERVER['REQUEST_URI'])) { //check is REQUEST_URI exist
			
			$requestUri = $_SERVER['REQUEST_URI'];
		}
		else {
			throw new Exception("address is empty");
		}
		$requestUri = trim($requestUri, '/'); //remove / (slash) from end of path
		//var_dump($requestUri);		
		if (empty($requestUri)) { //path is empty
			
			return false;//var_dump($_GET);
		}
		
		$array = explode('/',$requestUri); //divide path via /
		$count = count($array);
		//echo $count;
		
		//first and second element are model and action
		$controllerName = $array[0];
		$actionName = isset($array[1]) ? $array[1] : ''; //when some on won`t give action
		
		//next are parameter name and parameter value and they are change for 2
		if ($count > 2) {
			for ($i = 2; $i < $count; $i += 2) {
							
				$parameterName = $array[$i]; //parameter name
				$parameterValue = isset($array[$i+1]) ? $array[$i+1] : ''; //parameter value
				$parameter[$parameterName] = $parameterValue;
			}
		}
		else {
			
			$parameter = null;
		}
		return [$controllerName, $actionName,$parameter];
		
	}
	
	
	
	/*
	
	
	public function Url($path = null) {
		
		if (empty($path)) { //pusta ścieżka
			
			$pars = array();
		}
			else {	
			
				$pars = explode('&', $path);
			}
			$params = array();
			foreach ($pars as $_param){
					$_arP = explode('=',$_param,2); //par=war dzielimy na par i war
					$params[$_arP[0]] = isset($_arP[1]) ? $_arP[1] : '';
				}
				$strRet = '';
				if (!empty($params)){
					if ($params['model'] == $_GET['model'] && $params['action'] == $_GET['action']){ //moduł news akcja show zamienimy na link .html
						return $this->url.$params['name'].','.$params['id'].'.php';
					} else { //każdy inny moduł leci standardowo modul/akcja/parametr/wartosc
						foreach ($params as $_key => $_val){
							if ($_key == 'model' || $_key == 'action')
								$_key = '';
								else
									$_key.='/';
									$strRet.="$_key$_val/";
						}
					}
				}
				return $this->url.htmlspecialchars($strRet);
	}
	
	*/
}












