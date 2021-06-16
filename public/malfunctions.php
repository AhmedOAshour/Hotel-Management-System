<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Malfunction.php");

require_once(APPROOT . "/controllers/MalfunctionController.php");

require_once(APPROOT . "/views/pages/ViewMalfunction.php");
$model=new Malfunction();

$controller=new MalfunctionController($model);

$view=new ViewMalfunction($controller,$model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
		case 'addform':
			$view->addForm($_SESSION['username']);
			break;
			case 'add':
			$controller->insert($_SESSION['username']);
			$view->output();
			break;	
	
	}
}
else
	echo $view->output();

    ?>
