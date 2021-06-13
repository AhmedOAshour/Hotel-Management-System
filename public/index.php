<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/User.php");
require_once(APPROOT . "/controllers/UserController.php");
require_once(APPROOT . "/views/pages/ViewUser.php");
$model=new User();
$controller=new UserController($model);
$view=new ViewUser($controller,$model);

if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
		case 'loginForm':
			echo $view->loginForm();
			break;
    case 'login':
  		echo $controller->login($_GET['username'], $_GET['password']);
  		break;
		case 'forgotPass':
			$controller->forgotPass());
			break;
		case 'security':
			$controller->security($_GET['username']);
			echo $view->output();
      break;
	}
}
