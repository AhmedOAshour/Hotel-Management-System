<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/User.php");
require_once(APPROOT . "/controllers/UserController.php");
require_once(APPROOT . "/views/pages/ViewUser.php");
$model=new User();
$controller=new UserController();
$view=new ViewUser($controller,$model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
		case 'edit':
			echo $view->editForm($_GET['id']);
			break;
		case 'delete':
			$controller->delete($_GET['id']);
			echo $view->output();
            break;
        case 'add':
            $view->addForm();

	
	}
}
else
	echo $view->output();




?>