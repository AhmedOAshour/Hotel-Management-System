<?php
include "nav.php"
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/typeit@7.0.4/dist/typeit.min.js"></script>
<style>
body{
  overflow-x: hidden;
  background-color:#DAE3EB;
}
table,th,td,tr{
  border:1px solid black;
}
th,td{
  padding: 15px;
  text-align: left;
}
th{
  background-color: grey;
  color: white;
}
table{
  width: 100%;
  position:relative;
}
h2{
  text-align:center;
  margin-top:20px;
  margin-bottom:20px;
}
.button{
  position: relative;
  bottom: 35px;
  font-size: 1.25em;
  font-weight: 700;
  color: white;
  background-color: grey;
  display: inline-block;
  cursor: pointer;
  border: 1px solid black;
  width:50%;
  left:250px;
}
.button:focus,
.button:hover{
  background-color: rgb(121, 117, 117);
}

.names{
  font-size:20px;
}
</style>
  </head>
  <body>
  </body>
<div class="container">

<?php
session_start();
// include 'dbhandler.php';
$con = mysqli_connect('localhost','root','','hotel');
$id = $_GET['id'];
$sql1 = "SELECT * FROM user WHERE id = $id";
$result = mysqli_query($con,$sql1);
$row = mysqli_fetch_array($result);
echo "<form class='editE' action='' method='post'>
  <label class='names' for='Fname'>First Name</label><input type='text' name='Fname' id='Fname' class='formE form-control border-0 ' value='' placeholder = '".$row['first_name']."''> <br><br>
  <label class='names' for='Lname'>Last Name</label><input type='text' name='Lname' id='Lname' class='formE form-control border-0 ' value='' placeholder = '".$row['last_name']."''> <br><br>
  <label class='names' for='username'>username</label><input type='text' name='username' id='username' class='formE form-control border-0 ' value='' placeholder = '".$row['username']."''> <br><br>
  <label class='names' for='password'>password</label><input type='password' name='password' id='password' class='formE form-control  border-0' value='' placeholder = '".$row['password']."''> <br><br>
  <label class='names' for='position'>position</label>
  <select id='position' name='position' class='formE form-control mb-2 border-0'>
  <option value='front_clerk'>Front Clerk</option>
  <option value='reservation_clerk'>Reservation Clerk</option>
  <option value='HK_employee'>HouseKeeping Clerk</option>
  </select> <br><br>
  <input type='submit' name='submit' class='button'>
</form>";



if (isset($_POST['submit'])) 
{
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
</div>
</html>
