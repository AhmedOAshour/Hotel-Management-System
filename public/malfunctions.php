<style media="screen">
	#access{
		text-align: center;
		color: red;
	}
</style>
<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Malfunction.php");
require_once(APPROOT . "/controllers/MalfunctionController.php");
require_once(APPROOT . "/views/pages/ViewMalfunction.php");

$model=new Malfunction();
$controller=new MalfunctionController($model);
$view=new ViewMalfunction($controller,$model);

if (isset($_SESSION['position'])) {
	if ($_SESSION['position'] == "HK_employee" || $_SESSION['position'] == "HK_employee") {
		if (isset($_GET['action']) && !empty($_GET['action'])) {
			switch($_GET['action']){
				case 'addform':
					$view->addForm($_SESSION['username']);
					break;
					case 'Add':
						if(!$temp=$controller->insert($_SESSION['username'])){
							header("location:malfunctions.php");
							}
							else{
								$_SESSION['errors']=$temp;
								header("location:malfunctions.php?action=addform");
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
