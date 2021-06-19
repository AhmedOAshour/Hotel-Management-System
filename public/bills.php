<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Bill.php");
require_once(APPROOT . "/controllers/BillController.php");
require_once(APPROOT . "/views/pages/ViewBill.php");
$model=new Bill();

$controller=new BillController($model);
$view=new ViewBill($controller,$model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
		case 'read':
			echo $view->read($_GET['id']);
			break;
         case 'delete':
            $controller->delete($_GET['itemid']);
            echo $view->read($_GET['id']);
             break;
		case 'addform':
			echo $view->addForm($_GET['id']);
			break;
		case 'add':
			$controller->insertItem($_GET['id']);
			echo $view->read($_GET['id']);
	}
}
else
	echo $view->output();

