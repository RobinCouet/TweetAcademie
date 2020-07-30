<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
session_start();
$params = $_GET['params'];
$params = explode("/", $params);
$url = $params[0];
if (!isset($params[1])) {
  if (isset($_SESSION['login']))
    $action = "home";
  else
    $action = "connexion";
}
else {
  $action = $params[1];
}

require('model/database.php');
if (file_exists("controller/controller_". $url . ".php")) {
  include("controller/controller_" . $url . ".php");
  $page = new $url();
  if (method_exists($url, $action)) {
    array_splice($params, 0, 2);
    call_user_func_array(array($page, $action), $params);
  }
  else
    include ("controller/controller_error.php");
}
else if ($url === "") {
  include("controller/controller_home.php");
  $page = new home();
  $page->$action();
}
else
  include ("controller/controller_error.php");
