<style media="screen">
	#access{
		text-align: center;
		color: red;
	}
</style>
<script src="js/reservation.js"></script>
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

if (isset($_SESSION['position'])) {
	if ($_SESSION['position'] == "front_clerk") {
		if (isset($_REQUEST['q'])) {
			echo $view->table(false,$_REQUEST['from'],$_REQUEST['to']);
		}
		else {
			require_once ('../app/views/inc/nav.php');
			if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
				switch($_REQUEST['action']){
					case 'delete':
					$controller->delete($_REQUEST['id']);
					$view->output(false);
					break;
					case 'edit':
					$view2->editForm($_REQUEST['id'],$_REQUEST['quantity']);
					break;
					case 'editRes':
					$controller->edit($_REQUEST['id']);
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
		}
	}
	else {
		echo "<h2 id='access'>Access restricted.</h2>";
	}
}
else {
	echo "<h2 id='access'>Access restricted.</h2>";
}


?>
