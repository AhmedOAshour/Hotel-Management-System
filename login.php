<html>
<head>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #DAE3EB;
}
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  border: 1px solid black;
  box-sizing: border-box;
}
button {
  background-color: #36486b;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
button:hover {
  opacity: 0.8;
}
.CloseButton {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}
.container {
  padding: 16px;
}
.modal {
  display: none;
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.4);
  padding-top: 60px;
}
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto;
  border: 1px solid #888;
  width: 80%;
}
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}
.login{
  position: relative;
  left: 550px;
  top: 300px;
  width:400px;
}
</style>
</head>
<body>
    <button class="login"onclick="document.getElementById('id01').style.display='block'" >Login</button>
    <div id="id01" class="modal">
        <form class="modal-content animate" action="" method="post">
            <div class="CloseButton">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>
            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                <button type="submit" name="submit">Login</button>
                <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>
        </form>
    </div>


</body>
</html>

<?php
session_start();
include "php/classes.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";
$conn = new mysqli($servername, $username, $password, $dbname);
if(isset($_POST["submit"]))
{



$username=$_POST['uname'];
$password=$_POST['psw'];
   $sql="SELECT * from user where username='$username'";
   $result = mysqli_query($conn,$sql);

   if($row=mysqli_fetch_array($result)){
   if($row[5]=="front_clerk"){
$_SESSION["position"]=new Front_Office();
$result=$_SESSION["position"]->login($username,$password);
header("Location:Rooms.php");

   }
   else if($row[5]=="admin"){
    $_SESSION["position"]=new admin();
    $result=$_SESSION["position"]->login($username,$password);
    header("Location:viewEmployees.php");
   }
   else if($row[5]=="HK_employee"){
    $_SESSION["position"]=new HK();
    $result=$_SESSION["position"]->login($username,$password);

   }
   if($_SESSION['username']=$row[3])
   $_SESSION['Role']=$row[5];
  




   }
   else echo "Wrong password";



}
?>
