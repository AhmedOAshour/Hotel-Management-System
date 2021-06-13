<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Client.php");
require_once(APPROOT."/models/Room.php");
require_once(APPROOT . "/controllers/ClientController.php");
require_once(APPROOT . "/controllers/RoomController.php");
require_once(APPROOT . "/views/pages/ViewClient.php");
$model=new Client();
$model2=new Room();
$controller=new ClientController($model);
$controller2=new RoomController($model2);
$view=new ViewClient($controller,$model);
$view2=new ViewClient($controller2,$model2);
if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
        case 'addform':
            $view->addForm();
			break;
		case 'add':
			$controller->insert();
			$view->output();
			break;
		case 'resform':
			$view2->resForm($_GET['id']);
			break;
		case 'createRes':
			$controller->createReservation();
			$view->output();
			break;
	
	}
}
else
	echo $view->output();