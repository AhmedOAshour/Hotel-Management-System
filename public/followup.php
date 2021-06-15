<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Followup.php");
require_once(APPROOT . "/controllers/FollowupController.php");
require_once(APPROOT . "/views/pages/ViewFollowup.php");
$model=new Followup();
$controller=new followupController($model);
$view=new ViewFollowup($controller,$model);

if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
	switch($_REQUEST['action']){
		case 'followupForm':
			echo $view->followupForm();
			break;
    case 'submitForm':
    	echo $controller->insert($_POST['date'], $_POST['comment'], $_POST['type'], $_FILES['myfile']['name']);
      $view->outputFollowups($_REQUEST['type']);
    	break;
    case 'view':
    	echo $view->view($_REQUEST['id'], $_REQUEST['type']);
      break;
    case 'delete':
      $controller->delete($_REQUEST['id'], $_REQUEST['type']);
      $view->outputFollowups($_REQUEST['type']);
      echo "succcc";
      break;
	}
}
else {
  $type1 = "water";
  if (isset($_REQUEST['type'])) {
    $type1 = $_REQUEST['type'];
  }
	echo$view->outputFollowups($type1);
}
