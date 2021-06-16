<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/typeit@7.0.4/dist/typeit.min.js"></script>
<style>
    body{
        background-color: #DAE3EB;
    }
    .search{
        width:250px;
        border-top: none;
        border-right: none;
        border-left: none;
    }
    .row{
        background-color:white;
        width:100%;
        height:25px;
        margin:0;
        padding-top:10px;
    }
    .bar{
        text-align:left;
    }
    .searchbar{
        text-align:right;
    }
    .left{
        background-color:#EFEBEB;
        width:230px;
        height:590px;
        position: relative;
        top:15px;
        right:15px;
    }
    h3{
        position:relative;
        left:20px;
        color:#36486b;
        font-family:fantasy;
    }
    .title{
        position: relative;
        top:20px;
        left:0px;
    }
    .card{
        position: relative;
        top:20px;
        left:0px;
    }
    </style>
<?php
require_once("../app/bootapp.php");
require_once(APPROOT."/models/Room.php");
require_once(APPROOT . "/controllers/RoomController.php");
require_once(APPROOT . "/views/pages/ViewRoom.php");

$model=new Room();
$controller=new RoomController($model);
$view=new ViewRoom($controller,$model);

if (isset($_GET['action']) && !empty($_GET['action'])) {
	switch($_GET['action']){
		case 'editform':
			echo $view->editForm($_GET['id']);
			break;
	}
}
else
	echo $view->output();
?>
