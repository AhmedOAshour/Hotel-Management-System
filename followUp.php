
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<?php ob_start(); 
include "nav.php";?>
<html>
<head>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #ead3cb;
}
.py-100{
    padding: 100px 0;
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
							<h1 class="head">Follow up</h1>
							<input type="date"class="forms form-control mb-1 py-4 " name="date" ><br>
							<textarea type="text"class="forms form-control mb-4 "id="fname" name="comments" placeholder="Comments.."></textarea><br>
                            <input type="file" class=" inputfile btn w-100 py-3 mb-3" name="img" accept="image/*" ><br>
							<input type="submit"class="inputfile btn w-100 py-3" value="Submit" name="Submit">
						</div>
					</form>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>
<?php
ob_end_flush();
?>