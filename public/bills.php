<style media="screen">
	#access{
		text-align: center;
		color: red;
	}
</style>
<?php
require_once ('../app/views/inc/nav.php');<?php

require_once("../app/bootapp.php");
require_once(APPROOT."/models/Bill.php");
require_once(APPROOT . "/controllers/BillController.php");
require_once(APPROOT . "/views/pages/ViewBill.php");
require_once ('../app/views/inc/nav.php');

$model=new Bill();
$controller=new BillController($model);
$view=new ViewBill($controller,$model);

if (isset($_SESSION['position'])) {
if ($_SESSION['position'] == "front_clerk") {
	if (isset($_GET['action']) && !empty($_GET['action'])) {
		switch($_GET['action']){
			case 'read':
				echo $view->read($_GET['id']);
				break;
	   case 'delete':
	      $controller->delete($_GET['itemid']);
	      header("Location: bills.php?action=read&id=$_GET[id]");
	       break;
			case 'addform':
				if(isset($_SESSION['CID'])){
					$view->addform($_SESSION['CID']);
			   }
			   else{
				   $view->addform($_GET['id']);
			   }
			break;
			case 'add':
				if(!$temp=$controller->insertItem($_GET['id'])){
					header("Location: bills.php?action=read&id=$_GET[id]");
					}
					else{
						$_SESSION['errors']=$temp;
						header("location:bills.php?action=addform");
					}
					break;
			case 'checkoutview':
				echo $view->checkout($_GET['id']);
		}
	}
	else
		echo $view->output();
}
else {
	echo "<h2 id='access'>Access restricted.</h2>";
}
}
else {
	header("location:index.php");
}
