<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="js/employees.js"></script>
  </head>
  <body>

  </body>

<?php
session_start();
// include 'dbhandler.php';
$con = mysqli_connect('localhost','root','','hotel');
$id = $_GET['id'];
$sql1 = "SELECT * FROM user WHERE id = $id";
$result = mysqli_query($con,$sql1);
$row = mysqli_fetch_array($result);
echo "<form class='editE' action='' method='post'>
  <!-- <label for='username'>Username</label> <input type='text' name='username' id='username' class='formE' value='' required > <br><br> -->
  <label for='Fname'>First Name</label> <input type='text' name='Fname' id='Fname' class='formE' value='' placeholder = '".$row['first_name']."' required style='margin-left:30px;'> <br><br>
  <label for='Lname'>Last Name</label> <input type='text' name='Lname' id='Lname' class='formE' value='' placeholder = '".$row['last_name']."' required style='margin-left:32px;'> <br><br>
  <label for='username'>username</label> <input type='text' name='username' id='username' class='formE' value='' placeholder = '".$row['username']."' required style='margin-left:5.5px;'> <br><br>
  <label for='password'>password</label> <input type='password' name='password' id='password' class='formE' value='' placeholder = '".$row['password']."' required style='margin-left:32px;'> <br><br>
  <label for='position'>position</label>
  <select id='position' name='position' class='formE' style='margin-left:39.5px;'>
  <option value='front_clerk'>Front Clerk</option>
  <option value='reservation_clerk'>Reservation Clerk</option>
  <option value='HK_employee'>HouseKeeping Clerk</option>
  </select> <br><br>
  <input type='submit' name='submit'>
</form>";

if (isset($_POST['submit'])) {
  $Fname = $_POST['Fname'];
  $Lname = $_POST['Lname'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $position = $_POST['position'];
  $sql2 = "UPDATE user SET first_name = " . "'$Fname'" . ", last_name = " . "'$Lname'" . ", password = " . "'$password'" . ", position = " . "'$position'" . ", username = " . "'$username'" . " WHERE ID = " . $id;
  $result2 = mysqli_query($con,$sql2);
  echo $sql2;
  header('Location: ../ViewClients.php');
}
mysqli_close($con);
?>
</html>
