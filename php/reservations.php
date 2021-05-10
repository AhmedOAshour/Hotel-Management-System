<?php
function showReservations($flag){
  $bar = $_POST['bar'];
  $select = $_POST['select'];
  $sql = "SELECT * FROM reservation";
  $sql2 = "SELECT * FROM reservation WHERE $select LIKE '%$bar%'";
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
    echo "<td>" . $row['identification_no'] . "</td>";
    echo "<td>" . $row['mobile'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['company'] . "</td>";
    echo "<td style='text-align:center'>" . "<a href='viewReservation?id=$row[ID'>View</a>" . "</td>";
    }
  }
}

switch ($_POST['q']) {
  case 'view':
    showReservations();
    break;
}
?>
<a href="viewReservation?id=$row[ID">View</a>
