<style>
.color{
  color:#36486b;
}
.color:hover{
  color:blue;
  text-decoration:none;
}
</style>
<?php
session_start();
include "classes.php";
$GLOBALS['admin']=new admin();

// include "dbhandler.php";

function viewE(){

  $result=$GLOBALS['admin']->display_employee();

  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td style='text-align:center'>" . $row['ID'] . "</td>";
  echo "<td style='text-align:center'>" . $row['first_name'] . "</td>";
  echo "<td style='text-align:center'>" . $row['last_name'] . "</td>";
  echo "<td style='text-align:center'>" . $row['username'] . "</td>";
  if ($row['position'] == "HK_employee") {
   echo "<td style='text-align:center'>House Keeping Employee</td>";
  }
  elseif ($row['position'] == "reservation_clerk") {
   echo "<td style='text-align:center'>Reservation Clerk</td>";
  }
  elseif ($row['position'] == "front_clerk") {
    echo "<td style='text-align:center'> Front Office Clerk</td>";
  }
  elseif ($row['position'] == "admin") {
    echo "<td style='text-align:center'>Admin</td>";
  }
  echo "<td style='text-align:center'><a class='color' type='button' name='edit' onclick='editEmployee(".$row['ID'].")'><i class='fa fa-edit'></i></a></td>";
  echo "<td style='text-align:center'><a class='color' type='button' name='delete' onclick='deleteEmployee(".$row['ID'].")'><i class='fa fa-trash'></i></a></td>";
  echo "</tr>";
  }
}


function addE(){
  $fields=[

    "first_name"=>$_POST['Fname'],
    "last_name"=>$_POST['Lname'],
    "username"=>$_POST['username'],
    "password"=>$_POST['password'],
    "position"=>$_POST['position']


    ];



    $GLOBALS['admin']->create_employee($fields);


}

function deleteE(){
  $id = intval($_POST['ID']);

  $GLOBALS['admin']->delete_employee($id);
}

switch ($_POST['q']) {
  case 'add':
    addE();
    break;

  case 'del':
    deleteE();
    break;

  case 'view':
    viewE();
    break;

}

?>
