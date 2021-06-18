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
		case 'editform':
			echo $view->editForm($_GET['id']);
			break;
		case 'edit':
			$controller->edit($_GET['id']);
			header("Location: employees.php");
			break;
		case 'delete':
			$controller->delete($_GET['id']);
			echo $view->output();
      break;
    case 'addform':
      $view->addForm();
			break;
		case 'Add':
			$controller->insert();
			$view->output();
			break;
	}
}
else
	echo $view->output();
?>
