<script src="js/malfunctions.js"></script>
<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Malfunction.php");
require_once(APPROOT . "/controllers/MalfunctionController.php");
require_once(APPROOT . "/views/pages/ViewMalfunction.php");
$model=new Malfunction();
$controller=new MalfunctionController($model);
$view=new ViewMalfunction($controller,$model);
if (isset($_REQUEST['q'])) {
	echo $view->table($_REQUEST['from'], $_REQUEST['to'], $_REQUEST['bar']);
}
else {
	require_once ('../app/views/inc/nav.php');

	if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
		switch($_REQUEST['action']){
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
?>
