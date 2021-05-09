<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form method="post">
      <input id="count" type='text' name='guest_count' placeholder="Guest Count"><br>
      <textarea name="guest_names" rows="8" cols="40" placeholder="Guest Names seperate by ,"></textarea> <br>
      <label for="room_type">Room Type:</label> <select class="" name="room_type">
        <?php
            $sql = "SELECT DISTINCT type FROM room";
            $conn = new mysqli("localhost", "root", "", "hotel");
            $result = mysqli_query($conn,$sql);
            $conn->close();
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value='$row[type]'>$row[type]</option>";
            }
        ?>
        <option value="">Single</option>
      </select>
      <label for="room_floor">Room Floor:</label> <select class="" name="room_floor">
        <?php
          $sql = "SELECT DISTINCT floor FROM room";
          $conn = new mysqli("localhost", "root", "", "hotel");
          $result = mysqli_query($conn,$sql);
          $conn->close();
          while ($row = mysqli_fetch_array($result)) {
            echo "<option value='$row[floor]'>$row[floor]</option>";
          }
        ?>
      </select>
      Arrival: <input type='date' name='arrival'>
      Departure: <input type='date' name='departure'><br>
      <textarea name="comments" rows="8" cols="80" placeholder="Comments..."></textarea> <br>
      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>
<html>

<?php
include "php/classes.php";

$user=new Front_Office();
if(isset($_POST["submit"])){
  $price = 0;
  $client_id = 50;
$user->create_reservation($client_id,$_POST['room_type'],$_POST['room_floor'],$_POST['guest_names'],$_POST['guest_count'],$price,$_POST['arrival'],$_POST['departure'],$_POST['comments']);
}
?>
