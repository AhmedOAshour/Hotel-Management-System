<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<html>
<head>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #ead3cb;
}
.py-100{
    padding: 180px 0;
}
.online{
    background-color:#ead3cb;
}
.online h1{
    font-size: 48px;
    color:black;
}

.inputfile{
    position: relative;
    bottom: 35px;
    font-size: 1.25em;
    font-weight: 700;
    color: black;
    background-color: #845460;
    display: inline-block;
    cursor: pointer;
    border: 1px solid #433520;
}
.inputfile:focus,
.inputfile:hover {
    background-color: #7b113a;
    color:white;
}
h5{
    position: relative;
    bottom:220px;
    left:530px;
    color : red;
}

.forget{
	text-decoration:none;
	font-weight:bold;
    position: relative;
    bottom:30px;
    color:black;
}
.forget:hover{
	text-decoration:none;
    color: #7b113a;
    }

.pos{
	width:500px;
}
.head{
	text-align:center;
	position:relative;	
}
.forms{
    border:1px solid #433520;
    background-color: white;
}
</style>
</head>
<body>
<div class="online py-100">
		<div class="container pos">
			<div class="row">
				<div class="col-lg">
					<form action="" method = "post">
						<div class="form">	
							<h1 class="head">Login</h1>
							<input type="text"class="forms form-control mb-4 py-4 " name="uname"placeholder="Enter username.."><br>
							<input type="password"class="forms form-control mb-4  py-4 "id="fname" name="psw" placeholder="Your password.."><br>
							<input type="submit"class="inputfile btn w-100 py-3" value="Login" name="Submit">
							<a href="forgot.php" class="forget">Forgot Password?</a>
						</div>
					</form>
				</div>
			</div>	
		</div>
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
