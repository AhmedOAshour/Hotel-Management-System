<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
		<style media="screen">
			#access{
				text-align: center;
				color: red;
			}
		</style>
	</head>
	<body>

	</body>
</html>
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

if ($_SESSION['position'] == "front_clerk") {
	if (isset($_GET['action']) && !empty($_GET['action'])) {
		switch($_GET['action']){
	    case 'addform':
	      $view->addForm();
				break;
			case 'Add':
				if(!$temp=$controller->insert()){
				header("location:clients.php");
				}
				else{
					$_SESSION['errors']=$temp;
					header("location:clients.php?action=addform");
				}
				break;
			case 'resform':
				if(isset($_SESSION['CID'])){
					 $view2->resForm($_SESSION['CID'],$_SESSION['quantity']);
				}
				else{
					$view2->resForm($_GET['id'],$_GET['quantity']);

				}
				break;
			case 'createRes':
				if(!$temp=$controller->createReservation($_GET['quantity'])){
					header("location:reservations.php");
					}
					else{
						$_SESSION['errors']=$temp;

						header("location:clients.php?action=resform");
					}
					break;
			case 'editform':
				if(isset($_SESSION['CID'])){
					echo $view->editForm($_SESSION['CID']);


				}
				else{
					echo $view->editForm($_GET['id']);

				}
				break;
			case 'edit':
				if(!$temp=$controller->edit()){
					header("location:clients.php");
					}
				else{
						$_SESSION['errors']=$temp;

						header("location:clients.php?action=editform");
					}
				break;
			case 'delete':
				$controller->delete($_GET['id']);
				echo $view->output();
				break;
		}
	}
	else
		echo $view->output();
}

	else {
		echo "<h2 id='access'>Access restricted.</h2>";
	}
