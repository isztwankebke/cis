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
	private $postData = null;

	public function __construct($data) {

		//get url data from REQUEST_URI; there always will be= / if empty or / controller/action/param1/...paramN

		$this->url = $_SERVER['REQUEST_URI'];
		$this->requestMethod = $_SERVER['REQUEST_METHOD'];
		$this->postData = $_POST;
		//var_dump($_POST);
		
		$this->decodeURL2();

	}

	public function getPostData() {
		return $this->postData;

	}

	private function decodeURL2() {

		$explodedURL = explode('/', $this->url);
		array_shift($explodedURL);

		if (count($explodedURL)) {
			if (isset($explodedURL[0])) {
				$this->requestedControllerName = ucfirst("{$explodedURL[0]}Controller");
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
		if (debug) {
			var_dump($this->getControllerName());
			var_dump(class_exists($this->getControllerName()));
		}
		
		//var_dump(method_exists($this->getControllerName(), $this->getActionName()));
		
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
