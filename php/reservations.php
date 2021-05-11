<?php
function showReservations(){
  $bar = $_POST['bar'];
  $select = $_POST['select'];
  $sql = "SELECT * FROM reservation INNER JOIN client ON reservation.client_ID = client.ID";
  $sql2 = "SELECT * FROM reservation INNER JOIN client ON reservation.client_ID = client.ID WHERE $select LIKE '%$bar%'";
  $conn = new mysqli("localhost", "root", "", "hotel");
  if($bar == ""){
    $result = mysqli_query($conn,$sql);
  }
  else {
    $result = mysqli_query($conn,$sql2);
  }
  if (mysqli_num_rows($result) == 0) {
     echo "No result found";
  }
  else{
    while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['nationality'] . "</td>";
    echo "<td>" . $row['room_type'] . "</td>";
    echo "<td>" . $row['room_floor'] . "</td>";
    echo "<td>" . $row['arrival'] . "</td>";
    $arrival = strtotime($row['arrival']);
    $departure = strtotime($row['departure']);
    // divide seconds by 86400 to get nights
    $nights = ($departure - $arrival) / (86400);
    $days = $nights + 1;
    echo "<td>" . "$days/$nights" . "</td>";
    echo "<td style='text-align:center '>" . "<a href='viewReservation?id=$row[ID]'>View</a>" . "</td>";
    }
  }
}

switch ($_POST['q']) {
  case 'show':
    showReservations();
    break;
}
?>
