<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Maintenance.php");

require_once(APPROOT . "/controllers/MaintenanceController.php");

require_once(APPROOT . "/views/pages/ViewMaintenance.php");
$model=new Maintenance();

$controller=new MaintenanceController($model);

$view=new ViewMaintenance($controller,$model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
			case 'addpage':
			header("location:malfunctions.php?flag=true");
			break;
			case 'addform':
			$view->addform($_GET['id']);
			break;
			case 'insert':
			$controller->insert();
			//$controller->insert($_SESSION['username']);
			$view->output();
			
	
	}
}
else
	echo $view->output();

    ?>
