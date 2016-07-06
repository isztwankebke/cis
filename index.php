<?php
//echo "plik index.php";
//var_dump($_SERVER);
//die;
//include_once '../application/model/User.php';

/**
 *
 * magic function
 */


function __autoload($name) {
	
	//echo $name, "<br>";

	// testuj czy plik, ktory chcesz includowac istnieje ZANIM zaczniesz includowac
	
	// name == nameController
	// name == nameModel
	// name == nameView....
	
	try {
		if (preg_match('/Controller$/', $name)) {
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
		$path .= strtolower($name);
		$path .= '.php';
		
		
		if (!file_exists($path)) {
				
			throw new Exception("bad method name");
		}
		// laduj z library, gdy sie nie uda- rzuc wyjatkiem albo wyskocz przez okno...
	
	}
	catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	include_once $path;
	echo "<br>ładuje ścieżkę: " . $path. "<br>";
}
//var_dump($GLOBALS);


try {
	// domena/kontroler/akcja/param1/.../paramn
	$request = new Request($_SERVER);
	
	$controllerName = $request->getControllerName();
	
	//echo "<br>nazwa kontrolera=", $controllerName, "<br>";
	
	$actionName = $request->getActionName();
	
	//echo "<br>nazwa akcji=", $actionName, "<br>";
	
	$parameters = !null ? $request->getParameters() : "";
	
	//var_dump($parameters);
	
	if ($controllerName && $actionName) {
		
		$controller = new $controllerName($request);
		//var_dump($controller);
		$controller->$actionName($parameters);
	}
	
	
	
	
	
	
	//public function nazwa(param1, param2, param3);
}
catch (Exception $e) {
	// exception handling
}


die;
$request = new Request($_SERVER);
$controller = new UsersController();
$model = new UserModel();
$view = new UserView($controller, $model);
var_dump($GLOBALS);
die;



$user = new User();
$controller = new Controller($user);
$view = new View($controller, $user);


if (isset($_GET['action']) && !empty($_GET['action'])) {
	$controller->{$_GET['action']}();
}


var_dump($GLOBALS);
var_dump($_GET);


var_dump($_SERVER);
echo $view->output();







//$foo = 1;

$a = new CheckAccess();




$test = new Request($_SERVER);
var_dump($test);
die;

if ($test->isGet()) {
	echo "<br>request is get<br>";
}
elseif ($test->isPost()) {
	echo "<br>request is post<br>";
}

$test->DecodeURL();

var_dump($test->Url($_SERVER['REQUEST_URI']));
var_dump($_SERVER);

die;








$user = new User();
$sql = "SELECT `id` FROM `clients` WHERE 1";

$result = $user->query("SELECT name 
		FROM `users`
		 WHERE `password` = 'blabla'");


$result2 = $user->login('chris', 'blabla');
var_dump($result2);

if ($result) {
	$i = 1;
	foreach ($result as $row) {
		echo "{$i}: {$row['name']}<br/>";
		$i++;
	}
}
///var_dump($result);


//var_dump($_SERVER);

//$a->query("SELECT id `User`.`id` FROM `users` as `User` WHERE User.id = '" . $foo . "'");

//$result['User.id'] = 1;
//$result['User']['id'] = 1

die; 


include '/view/header.php';
?>
   <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dzisiejsze alerty</h1>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Produkt</th>
                  <th>Imie</th>
                  <th>Nazwisko</th>
                  <th>Nr telefonu</th>
                  <th>Warunek</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Produkt A</td>
                  <td>Jan</td>
                  <td>Kowalski</td>
                  <td>601100100</td>
                  <td>6rat</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Produkt A</td>
                  <td>Jan</td>
                  <td>Nowak</td>
                  <td>501200200</td>
                  <td>polowa kredytu</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Produkt C</td>
                  <td>Jan</td>
                  <td>Nowak</td>
                  <td>602200200</td>
                  <td>5rat</td>
                </tr>
                              </tbody>
            </table>
          </div>
        </div>

   <?php 
  include '/view/footer.php';
  ?>
