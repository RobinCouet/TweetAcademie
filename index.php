<?php
define('ROOT', __DIR__);

ini_set('display_errors', 'on');
error_reporting(E_ALL);
session_start();
$params = $_GET['params'];
$params = explode("/", $params);
$controller = $params[0];
$method = $params[1];

require('model/database.php');

if (file_exists("controller/controller_". $controller . ".php")) {
	include("controller/controller_" . $controller . ".php");
	$page = new $controller();
	if (method_exists($controller, $method)) {
		array_splice($params, 0, 2);
		call_user_func_array(array($page, $method), $params);
	} else {
		include("controller/controller_error.php");
	}
} else if ($url === "") {
	include("controller/controller_home.php");
	$page = new home();
	$page->$method();
} else {
	include("controller/controller_error.php");
}
