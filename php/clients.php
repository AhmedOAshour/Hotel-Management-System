<style>
.link{
  color:#36486b;
}
.link:hover{
  color:blue;
  text-decoration:none;
}
</style>
<?php
  include 'classes.php';

  function showClients($flag){
    $bar = $_POST['bar'];
    $select = $_POST['select'];
    $sql = "SELECT * FROM client";
    $sql2 = "SELECT * FROM client WHERE $select LIKE '%$bar%'";
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
      if($flag)
        echo "<td style='text-align:center'>" . "<a type='button' class='link'onclick='chooseClient($row[ID])'>Create Reservation</a>" . "</td>";
      echo "</tr>";
      }
    }
  }

  function addClient(){
    $sql = "INSERT INTO client(first_name, last_name, identification_no, nationality, mobile, email, company) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[identification_no]','$_POST[nationality]','$_POST[mobile]','$_POST[email]','$_POST[company]')";
    $conn = new mysqli("localhost", "root", "", "hotel");
    $result = mysqli_query($conn,$sql);
    echo $sql;
    $conn -> close();
  }

  switch ($_POST['q']) {
    case 'viewC':
      showClients(true);
      break;

    case 'view':
      showClients(false);
      break;

    case 'add':
      addClient();
      break;
  }
?>
