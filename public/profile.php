<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/User.php");
require_once(APPROOT . "/controllers/UserController.php");
require_once(APPROOT . "/views/pages/ViewUser.php");

$model=new User();
$controller=new UserController($model);
$view=new ViewUser($controller,$model);

if (isset($_SESSION['position'])) {
	if (isset($_GET['action']) && !empty($_GET['action'])) {
		switch($_GET['action']){
	    case 'view':
				$view->profile($_SESSION['username']);
				break;
			case 'changePass':
	      $view->changePasswordForm();
	      break;
	    case 'confirmPass':
	    if ($model->changePass($_GET['oldPass'], $_GET['newPass'], $_GET['cNewPass'])) {
	      $view->profile($_SESSION['username']);
	    }
	    else {
	      $view->changePasswordForm();
	      echo "Please fill in the form correctly.";
	    }
	    break;
		}
	}
	else {
		$view->profile($_SESSION['username']);
	}
}
else {
	header("location:index.php");
}
