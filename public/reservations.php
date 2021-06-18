<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Reservation.php");
require_once(APPROOT."/models/Room.php");
require_once(APPROOT . "/controllers/ReservationController.php");
require_once(APPROOT . "/controllers/RoomController.php");
require_once(APPROOT . "/views/pages/ViewReservation.php");
$model=new Reservation();
$model2=new Room();
$controller=new ReservationController($model);
$controller2=new RoomController($model2);
$view=new ViewReservation($controller,$model);
$view2=new ViewReservation($controller2,$model2);

if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
		case 'delete':
			$controller->delete($_GET['id']);
			echo $view->output(false);
            break;
		case 'edit':
			$view2->editForm($_GET['id'],$_GET['quantity']);
			break;
		case 'editRes':
			$controller->edit($_GET['id']);
			$view->output(false);
			break;
		case 'createReservation':
			header("location:clients.php?flag=true");
			break;
		case 'checkin':
			echo $view->output(true);
			break;



	}
}
else
	echo $view->output(false);

    ?>
