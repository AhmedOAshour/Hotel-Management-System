<style media="screen">
	#access{
		text-align: center;
		color: red;
	}
</style>
<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Maintenance.php");
require_once(APPROOT . "/controllers/MaintenanceController.php");
require_once(APPROOT . "/views/pages/ViewMaintenance.php");
require_once ('../app/views/inc/nav.php');
$model=new Maintenance();

$model=new Maintenance();
$controller=new MaintenanceController($model);
$view=new ViewMaintenance($controller,$model);

if (isset($_SESSION['position'])) {
	if ($_SESSION['position'] == "HK_employee" || $_SESSION['position'] == "front_clerk") {
		if (isset($_GET['action']) && !empty($_GET['action'])) {
			switch($_GET['action']){
					case 'addpage':
					header("location:malfunctions.php?flag=true");
					break;
					case 'addform':
						if(isset($_SESSION['CID'])){
							$view->addform($_SESSION['CID']);
					   }
					   else{
						   $view->addform($_GET['id']);
					   }
					break;
					case 'insert':
						if(!$temp=$controller->insert()){
							header("location:maintenance.php");
							}
							else{
								$_SESSION['errors']=$temp;

								header("location:maintenance.php?action=addform");
							}
							break;
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
	echo "<h2 id='access'>Access restricted.</h2>";
}


    ?>
