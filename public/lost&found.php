<style media="screen">
	#access{
		text-align: center;
		color: red;
	}
</style>
<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/LostAndFound.php");
require_once(APPROOT."/models/Room.php");
require_once(APPROOT . "/controllers/LostAndFoundController.php");
require_once(APPROOT . "/views/pages/ViewLostAndFound.php");
require_once ('../app/views/inc/nav.php');

$model=new LostAndFound();
$controller=new LostAndFoundController($model);
$view=new ViewLostAndFound($controller,$model);

if (isset($_SESSION['position'])) {
	if ($_SESSION['position'] == "HK_employee" || $_SESSION['position'] == "front_clerk") {
		if (isset($_GET['action']) && !empty($_GET['action'])) {
			switch($_GET['action']){
				case 'addform':
				$view->addForm($_SESSION['username']);
				break;
				case 'Add':
					if(!$temp=$controller->insert($_SESSION['username'])){
						header("location:lost&found.php");
						}
						else{
							$_SESSION['errors']=$temp;

							header("location:lost&found.php?action=addform");
						}
						break;
			}
		}
		else{
			echo $view->output();
		}
	}
	else {
		echo "<h2 id='access'>Access restricted.</h2>";
	}
}
else {
	header("location:index.php");
}

?>
