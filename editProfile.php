
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/typeit@7.0.4/dist/typeit.min.js"></script>
    <?php
include "nav.php"
?>
<style>
body{
  overflow-x: hidden;
  background-color:#ead3cb;
}
table,th,td,tr{
  border:1px solid black;
}
th,td{
  padding: 15px;
  text-align: left;
}
th{
  background-color: #845460;
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
    color: black;
    background-color: #845460;
    display: inline-block;
    cursor: pointer;
    border: 1px solid #433520;
    width:100%;
    height:50px;
}
.button:hover{
  background-color: #7b113a;
    color:white;
}
.names{
  font-size:25px;
}
.formE{
  height:50px;
}
</style>
<script src="JS/employees.js"></script>
  </head>
  <body>
  </body>
<div class="container">

<?php
ob_start();
// include 'dbhandler.php';
include "php/classes.php";
$GLOBALS['admin']=new admin();
$id = $_GET['id'];
$result = $GLOBALS['admin']->by_id($id);
$row = mysqli_fetch_array($result);
echo "
  <form class='editE' action='' method='post'>
  <label class='names' for='Fname'>First Name</label><input type='text' name='Fname' id='Fname' class='formE form-control border-0 ' value='".$row['first_name']."' '> <br><br>
  <label class='names' for='Lname'>Last Name</label><input type='text' name='Lname' id='Lname' class='formE form-control border-0 ' value='".$row['last_name']."' '> <br><br>
  <label class='names' for='username'>username</label><input type='text' name='username' id='username' class='formE form-control border-0 ' value='".$row['username']."' '> <br><br>
  <label class='names' for='password'>password</label><input type='password' name='password' id='password' class='formE form-control  border-0' value='".$row['password']."' '> <br><br>
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
  if (!preg_match('/[a-z]/', $_POST['password']) ||
      !preg_match('/[A-Z]/', $_POST['password']) ||
      !preg_match('/[\'^�$%&*()}{@#~?><>,|=_+�-]/', $_POST['password']))
  {
     echo "Password Must Contain a Lowercase, Uppercase and Special Character.";
     $flag = true;
  }
  elseif (preg_match('/[0-9]/', $_POST['Fname']) ||
          preg_match('/[0-9]/', $_POST['Lname']))
  {
     echo "Your Name Cannot Contain Numbers.";
     $flag = true;
  }
  elseif (strlen($_POST['password']) < 8)
  {
     echo "Your Password Must Be At Least 8 Characters.";
     $flag = true;
  }
  elseif (strlen($_POST['username']) > 20)
  {
     echo "Your Username Must Be At Less Than 20 Characters.";
     $flag = true;
  }

  if (!$flag) {
    $fields=[
      "id"=>$id,
      "first_name"=>$_POST['Fname'],
      "last_name"=>$_POST['Lname'],
      "username"=>$_POST['username'],
      "password"=>$_POST['password'],
      "position"=>$_POST['position']
      ];
      $GLOBALS['admin']->update_employee($fields);
      header("Location:viewEmployees.php");
  }
  else {
    return;
  }


}

ob_end_flush();
?>
</div>
</html>
