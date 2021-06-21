<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    .wrong{
      position: relative;
      left:475px;
      color:red;
    }
    </style>
  </head>
  <body>

  </body>
</html>
<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/User.php");
require_once(APPROOT . "/controllers/UserController.php");
require_once(APPROOT . "/views/pages/ViewUser.php");
require_once ('../app/views/inc/nav.php');
$model=new User();
$controller=new UserController($model);
$view=new ViewUser($controller,$model);


if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
		case 'loginform':
			echo $view->loginForm();
			break;
			case 'login':
				if($controller->login($_GET['username'], $_GET['password'])){
					  header('Location: rooms.php');
				  }
				  else {
					  $view->loginForm();
					  echo "<h5 class='wrong'>Wrong credentials.</h5>";
				  }
				break;
		case 'forgotpass':
			$view->forgotPass();
			break;
		case 'security':
		  $view->security($_GET['username']);
      break;
		case 'Validate':
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
