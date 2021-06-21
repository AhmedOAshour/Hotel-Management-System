<?php
ob_start();
?>
<style>
    body{
        background-color: #DAE3EB;
    }
    #access{
  		text-align: center;
  		color: red;
  	}
    .search{
        width:250px;
        border-top: none;
        border-right: none;
        border-left: none;
    }
    .sidebar{
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
        height:790px;
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
<script src="js/rooms.js"></script>
<body id="body">
  <?php
  require_once("../app/bootapp.php");
  require_once(APPROOT."/models/Room.php");
  require_once(APPROOT . "/controllers/RoomController.php");
  require_once(APPROOT . "/views/pages/ViewRoom.php");
  require_once ('../app/views/inc/nav.php');
  $model=new Room();
  $controller=new RoomController($model);
  $view=new ViewRoom($controller,$model);

if (isset($_SESSION['position'])) {
  if ($_SESSION['position'] == "admin" || $_SESSION['position'] == "front_clerk" || $_SESSION['position'] == "HK_employee") {
    if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
      switch($_REQUEST['action']){
        case 'view_room':
        echo $view->view_room($_GET['id']);
        break;
        case 'mark_available':
        $model->changeStatus($_GET['id'],"available");
        header("Location: rooms.php?action=view_room&id=$_GET[id]");
        break;
        case 'mark_unavailable':
        $model->changeStatus($_GET['id'],"unavailable");
        header("Location: rooms.php?action=view_room&id=$_GET[id]");
        break;
        case 'checkoutform':
          $view->checkout($_GET['id']);
          break;
          case 'checkout':
          $model->checkout($_REQUEST['id']);
          header("Location: rooms.php");
          break;
          case 'checkin':
          $view->checkin($_GET['id']);
          break;
          case 'checkedin':
          $model->checkin($_POST['rooms'],$_POST['id']);
          $view->output();
          break;
          case 'manage':
          $view->viewTable();
          break;
          case 'addform':
            $view->addForm();
            break;
            case 'add':
            if(!$temp=$controller->insert()){
      				header("Location: rooms.php?action=manage");
      				}
      				else{
      					$_SESSION['errors']=$temp;
      					header("location:rooms.php?action=addform");
      				}
            break;
            case 'editform':
              $view->editForm($_GET['number']);
              break;
              case 'edit':
              $controller->edit();
              header("Location: rooms.php?action=manage");
              break;
              case 'delete':
              $controller->delete();
              header("Location: rooms.php?action=manage");
              break;
            }
          }
          else
          $view->output();
  }
  else {
    echo "<h2 id='access'>Access restricted.</h2>";
  }

}
else {
  echo "<h2 id='access'>Access restricted.</h2>";
}
        ?>
</body>
