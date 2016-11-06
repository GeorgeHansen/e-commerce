<?php 

// http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/

/*
* This file should receive every request.
* If statements check which controller and action to route the request to. 
*
*/
if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'default';
    $action     = 'home';
  }

  require_once('views/layout.php');


 ?>