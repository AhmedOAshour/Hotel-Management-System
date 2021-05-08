<style>
.color{
  color:blue;
}
.color:hover{
  color:red;
  text-decoration:none;
}
</style>
<?php
session_start();
include "php/classes.php";
$GLOBALS['admin']=new admin();

// include "dbhandler.php";

function viewE(){

  $result=$GLOBALS['admin']->display();
  
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['ID'] . "</td>";
  echo "<td>" . $row['first_name'] . "</td>";
  echo "<td>" . $row['last_name'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  if ($row['position'] == "HK_employee") {
   echo "<td>House Keeping Employee</td>";
  }
  elseif ($row['position'] == "reservation_clerk") {
   echo "<td>Reservation Clerk</td>";
  }
  elseif ($row['position'] == "front_clerk") {
    echo "<td>Front Office Clerk</td>";
  }
  echo "<td align='center'><a class='color' type='button' name='edit' onclick='editEmployee(".$row['ID'].")'>Edit</a></td>";
  echo "<td align='center'><a class='color' type='button' name='delete' onclick='deleteEmployee(".$row['ID'].")'>Delete</a></td>";
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
    
    $GLOBALS['admin']->by_data($fields);
 
    $GLOBALS['admin']->insert($fields);
 

}

function deleteE(){
  $id = intval($_POST['ID']);
 
  $GLOBALS['admin']->delete($id);
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
