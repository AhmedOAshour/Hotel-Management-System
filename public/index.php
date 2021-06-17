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
		case 'loginform':
			echo $view->loginForm();
			break;
    case 'login':
  		echo $controller->login($_GET['username'], $_GET['password']);
		  $view->loginForm();
  		break;
		case 'forgotpass':
			$view->forgotPass();
			break;
		case 'security':
		  $view->security($_GET['username']);
      break;
		case 'validate':
			if ($model->validateAnswer($_GET['answer'], $_GET['username'])) {
				$view->newPassword($_GET['username']);
			}
			else {
				return false;
			}
	    break;
		case 'newPass':
		if ($model->newPassword($_GET['username'], $_GET['password'], $_GET['cPassword'])) {
        $view->loginForm();
				// unset($_REQUEST);
		}
		else {
			$view->newPassword($_GET['username']);
			echo "Passwords do not match.";
		}
	    break;
	}
}
else {
	echo $view->loginForm();
}