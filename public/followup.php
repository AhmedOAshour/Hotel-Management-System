<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Followup.php");
require_once(APPROOT . "/controllers/FollowupController.php");
require_once(APPROOT . "/views/pages/ViewFollowup.php");
require_once ('../app/views/inc/nav.php');
$model=new Followup();
$controller=new followupController($model);
$view=new ViewFollowup($controller,$model);

if(!$temp=$controller->insert()){
	header("location:employees.php");
	}
	else{
		$_SESSION['errors']=$temp;

		header("location:employees.php?action=addform");
	}

if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
	switch($_REQUEST['action']){
		case 'followupForm':
			echo $view->followupForm();
			break;
    case 'submitForm':
		if(!$temp=$controller->insert($_POST['date'], $_POST['comment'], $_POST['type'], $_FILES['myfile']['name'])){
      $view->outputFollowups($_REQUEST['type']);
		}
		else {
			$_SESSION['errors']=$temp;
			header("location:employees.php?action=addform");
		}
    	break;
    case 'view':
    	echo $view->viewFollowup($_REQUEST['id'], $_REQUEST['type']);
      break;
    case 'delete':
      $controller->delete($_REQUEST['id'], $_REQUEST['type']);
      $view->outputFollowups($_REQUEST['type']);
      break;
	}
}
else {
  $type1 = "water";
  if (isset($_REQUEST['type'])) {
    $type1 = $_REQUEST['type'];
  }
	$view->outputFollowups($type1);
}
