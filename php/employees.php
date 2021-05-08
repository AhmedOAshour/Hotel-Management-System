<style>
.color{
  color:blue;
}
</style>
<?php
session_start();
// include "dbhandler.php";
$con = mysqli_connect('localhost','root','','hotel');
function viewE($con){
  $sql = "SELECT * FROM user";
  $result = mysqli_query($con,$sql);
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['ID'] . "</td>";
  echo "<td>" . $row['first_name'] . "</td>";
  echo "<td>" . $row['last_name'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  if ($row['position'] == "HK_employee") {
   echo "<td>Reservation Clerk</td>";
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

function editE($con){
  $sql = "UPDATE user SET username = '$_POST[username]', password = '$_POST[password]', position = '$_POST[position]'";
  $result = mysqli_query($con,$sql);
}

function addE($con){

  $sql = "INSERT INTO user (username, password, first_name, last_name, position) VALUES ('$_POST[username]','$_POST[password]','$_POST[Fname]', '$_POST[Lname]', '$_POST[position]')";
  echo $sql;
  $result=mysqli_query($con,$sql);
}

function deleteE($con){
  $id = intval($_POST['ID']);
  $sql = "DELETE FROM user WHERE ID = $id ";
  $result = mysqli_query($con,$sql);
}

switch ($_POST['q']) {
  case 'add':
    addE($con);
    break;

  case 'del':
    deleteE($con);
    break;

  case 'edit':
    editE($con);
    break;

  case 'view':
    viewE($con);
    break;

}
mysqli_close($con);
?>
