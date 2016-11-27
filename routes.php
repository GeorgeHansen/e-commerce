<?php 

function call($controller, $action) {
    // require the file that matches the controller name
    require_once('Controllers/' . $controller . 'Controller.php');

    // create a new instance of the needed controller
    switch($controller) {
      case 'Registration':
        $controller = new RegistrationController();
      break;
      case 'Login':
        $controller = new LoginController();
      break;
      case 'User':
        $controller = new UserController();
      break;
      case 'Homepage' :
        $controller = new HomepageController();
      break;
    }

    // call the action
    $controller->{ $action }();
  }

  // just a list of the controllers we have and their actions
  // we consider those "allowed" values

  $controllers = array('Registration' => ['home','post','update','delete', 'error','testhome'],
                       'Login' => ['home','error','post'],
                      'User'  => ['home','post', 'error'],
                        'Homepage'     => ['home','error']);





  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('home', 'error');
    }
  } else {
    call('home', 'error');
  }


 ?>
