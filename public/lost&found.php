<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/LostAndFound.php");
require_once(APPROOT."/models/Room.php");
require_once(APPROOT . "/controllers/LostAndFoundController.php");
require_once(APPROOT . "/views/pages/ViewLostAndFound.php");
$model=new LostAndFound();
$controller=new LostAndFoundController($model);
$view=new ViewLostAndFound($controller,$model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
		case 'addform':
		$view->addForm($_SESSION['username']);
		break;
		case 'Add':
		$controller->insert($_SESSION['username']);
		$view->output();
		break;
	}
}
else
	echo $view->output();

    ?>
