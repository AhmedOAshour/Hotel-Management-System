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
			if(isset($_REQUEST['id'])){
				echo $view->editForm($_REQUEST['id']);


			}
			else{
				echo $view->editForm($_SESSION['CID']);

			}
			break;
		case 'edit':

			if(!$temp=$controller->edit()){
				header("location:employees.php");
				}
			else{
					$_SESSION['errors']=$temp;

					header("location:employees.php?action=editform");
				}

			break;
		case 'delete':
			$controller->delete($_GET['id']);
			echo $view->output();
      break;
    case 'addform':
      $view->addForm();
			break;
		case 'Add':
			if(!$temp=$controller->insert()){
				header("location:employees.php");
				}
				else{
					$_SESSION['errors']=$temp;

					header("location:employees.php?action=addform");
				}
				break;
	}
}
else
	echo $view->output();
?>
