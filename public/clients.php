<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Client.php");
require_once(APPROOT . "/controllers/ClientController.php");
require_once(APPROOT . "/views/pages/ViewClient.php");
$model=new User();
$controller=new UserController();
$view=new ViewUser($controller,$model);
if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
        case 'add':
            $view->addForm();
	}
}
else
	echo $view->output();