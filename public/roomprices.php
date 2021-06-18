<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/RoomPrices.php");
require_once(APPROOT . "/controllers/RoomPricesController.php");
require_once(APPROOT . "/views/pages/ViewRoomPrices.php");

$model=new RoomPrices();
$controller=new RoomPricesController($model);
$view=new ViewRoomPrices($controller,$model);

if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
	switch($_REQUEST['action']){
    case 'addform':
			$view->addForm();
			break;
    case 'add':
      $controller->insert();
      header("Location: roomprices.php");
      break;
    case 'editform':
      $view->editForm($_REQUEST['type']);
      break;
    case 'edit':
      $controller->edit();
      header("Location: roomprices.php");
	}
}
else
	$view->output();
?>
