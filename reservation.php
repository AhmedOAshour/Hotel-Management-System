<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form method="post">
      <input id="count" type='text' name='guest_count' placeholder="Guest Count"><br>
      <textarea name="name" rows="8" cols="40" placeholder="Guest Names seperate by ,"></textarea> <br>
      Arrival: <input type='date' name='arrival'>
      Departure: <input type='date' name='departure'><br>
      <textarea name="name" rows="8" cols="80" placeholder="Comments..."></textarea> <br>
      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>
<html>

<?php
include "php/classes.php";

$user=new Front_Office();
$user->
if(isset($_POST["submit"])){
$user->create_reservation(50,101,$_POST['guest_names'],$_POST['guest_count'],$_POST['arrival'],$_POST['departure'],$_POST['comments']);


}
?>
