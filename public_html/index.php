<?php

//bootstrap

define('debug', false);
//setting locale
//setlocale(LC_CTYPE, "Polish_Poland.1250");


/**
 *
 * magic function
 */
function __autoload($name) {

	try {
		if (preg_match('/controller$/i', $name)) {
			$folder = "controllers";
		}
		elseif (preg_match('/Model$/', $name)) {
			$folder = "models";
		}
		elseif (preg_match('/View$/', $name)) {
			$folder = "views";
		}
		else {
			$folder = "library";
		}

		$path = '../application/'.$folder.'/';
		$path .= $name;
		$path .= '.php';


		if (!file_exists($path)) {

			throw new Exception("bad controller, model or view name", 400);

		}
		

	}
	catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	include_once $path;
	
}




try {
	// domena/kontroler/akcja/param1/.../paramn
	$request = new Request($_SERVER);
	//var_dump($request);
	$controllerName = $request->getControllerName();

	//var_dump($controllerName);

	$actionName = $request->getActionName();

	//echo "<br>nazwa akcji=", $actionName, "<br>";


	$parameters = $request->getParameters();

	//var_dump($parameters);

	$controller = new $controllerName($request);
	//var_dump($controller);

	call_user_func_array(array($controller, $actionName), $request->getParameters('get'));
	//include '../application/views/Layouts/default.php';

	//public function nazwa(param1, param2, param3);
}
catch (Exception $e) {
	echo "caugh exxception: ", $e->getMessage();
	// exception handling
}


