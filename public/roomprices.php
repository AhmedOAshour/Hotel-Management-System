<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/RoomPrices.php");
require_once(APPROOT . "/controllers/RoomPricesController.php");
require_once(APPROOT . "/views/pages/ViewRoomPrices.php");
require_once ('../app/views/inc/nav.php');
$model=new RoomPrices();
$controller=new RoomPricesController($model);
$view=new ViewRoomPrices($controller,$model);

if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
	switch($_REQUEST['action']){
    case 'addform':
			$view->addForm();
			break;
    case 'add':
      if(!$temp=$controller->insert()){
        header("location:roomprices.php");
        }
        else{ 
          $_SESSION['errors']=$temp;
          
          header("location:roomprices.php?action=addform");
        }
        break;
    case 'editform':
      if(isset($_SESSION['CID'])){
			$view->editForm($_SESSION['CID']);
			}
			else{
			$view->editForm($_REQUEST['type']);
			}
			break;
    
    case 'edit':
      if(!$temp=$controller->edit()){
        header("Location:roomprices.php");
				}
			else{ 
					$_SESSION['errors']=$temp;
					
					header("location:roomprices.php?action=editform");
				}
			
			break;
     
	}
}
else
	$view->output();
?>
