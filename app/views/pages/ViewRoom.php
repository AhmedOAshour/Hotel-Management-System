<style>
  .button5{
    position: relative;
    width:50%;
    background-color:#000026;
    height:50px;
    font-weight:bolder;
    color:white;
    margin-bottom:5px;
    left:45px;
    border-radius: 15px;
  }
  .w3-blue{
    background-color:#000026 !important;
  }
  .cards{
    position:relative;
    left:334px;
  }
  .mainbody{
    overflow-y:scroll;
    height: 85vh;
  }
  body{
    overflow-y: hidden;
  }

</style>
<?php
  class ViewRoom extends View
  {
    function output(){
      $str = <<<EOD
      <div class="col-12">
            <div class="row sidebar">
                <div class="col-3 bar">
                    <form action="/action_page.php">
                    </form>
                </div>
                <div class="col-9 searchbar">
                    <input onchange="search()" id="search" class="search" type="text" placeholder="Search by room or guest's name"><i class="fa fa-search"></i>
                </div>
            </div>
        </div>
        <div>
            <div class="row sidebar">
                <div class="col-3">
                    <ul class="nav flex-column left">
                        <h3>Status</h3>
                        <li class="nav-item">
                            <input onclick="selectStatus(this)" type="checkbox" class="status" name="status1" value="booked" checked="true">
                            <label for="vehicle1">Booked</label><br>
                            <input onclick="selectStatus(this)" type="checkbox" class="status" name="status3" value="available" checked="true">
                            <label for="vehicle1">Available</label><br>
                            <input onclick="selectStatus(this)" type="checkbox" class="status" name="status3" value="unavailable" checked="true">
                            <label for="vehicle1">Unavailable</label><br>
                            <input onclick="selectStatus(this)" type="checkbox" class="status" name="status4" value="checked_out" checked="true">
                            <label for="vehicle1">CheckedOut</label><br>
                        </li>
                        <h3>Type</h3>
                        <li class="nav-item">
                            <input onchange="selectType(this)" type="checkbox" class="type" name="Type1" value="Single" checked="true">
                            <label>Single</label><br>
                            <input onchange="selectType(this)" type="checkbox" class="type" name="Type2" value="Double" checked="true">
                            <label>Double</label><br>
                            <input onchange="selectType(this)" type="checkbox" class="type" name="Type3" value="Triple" checked="true">
                            <label>Triple</label><br>
                            <input onchange="selectType(this)" type="checkbox" class="type" name="Type3" value="Family" checked="true">
                            <label>Family</label><br>
                            <input onchange="selectType(this)" type="checkbox" class="type" name="Type4" value="Suite" checked="true">
                            <label>Suite</label><br>
                        </li>
                        <li><a href="reservations.php?action=checkin"> <button class="button5"> Check In </button> </a></li>
                        <li><a href="rooms.php?action=manage"> <button class="button5"> Manage rooms </button> </a></li>
                    </ul>
                </div>
                <div class="col-9 mainbody">
      EOD;
      $types = $this->model->getRoomTypes();
      foreach ($types as $type) {
        $rooms = $this->model->readRooms("$type");
        $str .= <<<EOD
          <div class="col-9" id="$type">
            <h3 class="title">$type</h3>
            <div class="row">
        EOD;
        // make a function for each display type?
        foreach ($rooms as $room) {
          $class = $this->getClass($room->status);
          $title = $this->getTitle($room);
          $str .= <<<EOD
          <div onclick="view_room($room->number)" class="$room->number $title $room->status card text-black bg-$class mb-3 mx-3" style="width: 15rem;">
            <div class="card-header">Room $room->number</div>
                <div class="card-body">
                    <h2 class="card-title">$title</h2>
                    <p class="card-text"></p>
                </div>
            </div>
          EOD;
        }
        $str .= <<<EOD
          </div>
        </div>
        EOD;
      }
      $str .= <<<EOD
            </div>
        </div>
      EOD;
      echo $str;
    }

    function view_room($id){
      $room = new Room($id);
      $ext = "";
      if ($room->status == 'booked') {
        $res = $room->getReservation();
        $ext = <<<EOD
        <h4><b>Arrival: </b>$res[arrival]</h4>
        <h4><b>Departure: </b>$res[departure]</h4>
        <h4><b>Check In: </b>$res[check_in]</h4>
        <h4><b>First Name: </b>$res[first_name]</h4>
        <h4><b>Last Name: </b>$res[last_name]</h4>
        <h4><b>Identification Number: </b>$res[identification_no]</h4>
        <h4><b>Nationality: </b>$res[nationality]</h4>
        <h4><b>Mobile: </b>$res[mobile]</h4>
        <h4><b>Email: </b>$res[email]</h4>
        <h4><b>Company: </b>$res[company]</h4>
        EOD;
      }
      $str = <<<EOD
          <div class="container">
          <h1>Room Description</h1><br>
          <div class="w3-card-4 cards" style="width:40%;">
          <header class="w3-container w3-blue">
            <h1>$room->number</h1>
          </header>
          <div class="w3-container">
          <h4><b>Room type: </b>$room->type</h4>
          <h4><b>Room status: </b>$room->status</h4>
          <h4><b>Comments: </b>$room->comments</h4>
          $ext
          </div>
        </div>
        <br>
        <a href="rooms.php"><button class="button2">Back</button></a><br>
      EOD;
      switch ($room->status) {
        case 'booked':
          $str .= <<<EOD
          <button class="button2" onclick="checkout($res[reservation_ID])"> Check out </button>
          EOD;
          break;
        case 'available':
          $str .= <<<EOD
            <button class="button2" onclick="mark_unavailable($_GET[id])"> Mark as Unavailable </button>
          EOD;
          break;
        case 'unavailable'||'checked_out':
          $str .= <<<EOD
            <button class="button2" onclick="mark_available($_GET[id])"> Mark as Available </button>
          EOD;
          break;
      }
      $str .= <<<EOD
      EOD;
      echo $str;
    }

    function checkin($resID){
      $str = <<<EOD
      <div class="container">
      <h1>Check in</h1>
      <form action="rooms.php" method="POST">
      EOD;
      $resRooms = $this->model->getResTypes($_GET['id']);
      foreach ($resRooms as $key => $type) {
        $str .= <<<EOD
          <h3 class="words arr">$type</h2>
          <select class="formE form-control border-3"class="" name="rooms[]">
        EOD;
        $freeRooms = $this->model->getFreeType($type);
        foreach ($freeRooms as $room) {
          $str .= <<<EOD
            <option value="$room->number">$room->number</option>
          EOD;
        }
        $str .= <<<EOD
          </select><br>
        EOD;
      }
      $str .= <<<EOD
        <input class="formE form-control border-3" type="text" name='id' value=$_GET[id] style="display:none">
        <button type='submit' class="button2"name='action' value='checkedin'> Checkin </button>
        </form>
      EOD;
      echo $str;
    }

    function viewTable(){
      $rooms = $this->model->readRooms();
      $str = <<<EOD
      <div class="container">
      <h1>Manage Rooms</h1>
      <table>
      <thead>
        <th style='text-align:center'>Room Number</th>
        <th style='text-align:center'>Type</th>
        <th style='text-align:center'>Status</th>
        <th style='text-align:center'>Comments</th>
        <th style='text-align:center'>Edit</th>
        <th style='text-align:center'>Delete</th>
      </thead>
      <tbody>
      EOD;
      if($rooms){
          foreach ($rooms as $room) {
          $str .= <<<EOD
            <tr>
              <td style='text-align:center'>$room->number</td>
              <td style='text-align:center'>$room->type</td>
              <td style='text-align:center'>$room->status</td>
              <td style='text-align:center'>$room->comments</td>
              <td style='text-align:center'><a class="color"href="rooms.php?action=editform&number=$room->number"><i class='fa fa-edit'></i></a></td>
              <td style='text-align:center'><a class="color"href="rooms.php?action=delete&number=$room->number"><i class='fa fa-trash'></i></a></td>
            </tr>
          EOD;
        }
      }
      $str .= <<<EOD
      </tbody>
      </table>
      <a href="rooms.php"><button class="button2 ">Back</button></a><br>
      <a href="roomprices.php"><button class="button2">Manage Room Pricing</button></a><br>
      EOD;
      if ($_SESSION['position'] == 'admin') {
        $str .= <<<EOD
        <a href="rooms.php?action=addform"><button class="button2">Add a Room</button></a><br>
        EOD;
      }
      echo $str;
    }

    function addForm(){
      $number="";
      $type="";
      $status="";

      if(isset($_SESSION['errors'])){
        $errors=$_SESSION['errors'];

        if(isset($errors['number'])){
          $number=$errors['number'];
                                    }
        if(isset($errors['status'])){
        $status=$errors['status'];
        }
      }

      $str = <<<EOD
      <div class="container">
      <h1>Add Room</h1>
      <form method="POST">
        <h4 class="words">Room<br>Number</h4> <input class="formE form-control border-3" type="text" name="number" required><br>
        <h5 class="errors">$number</h5>
        <h4 class="words">Type</h4>
        <select name="type" class="formE form-control border-3" required>
          <option value="single">Single</option>
          <option value="double">Double</option>
          <option value="triple">Triple</option>
          <option value="family">Family</option>
          <option value="suite">Suite</option>
        </select><br>
        <h5 class="errors">$type</h5>
        <h4 class="words">Status</h4>
        <select name="status" class="formE form-control border-3" required>
          <option value="available">Available</option>
          <option value="unavailable">Unavailable</option>
        </select><br>
        <h5 class="errors">$status</h5>
        <h4 class="words">Comments</h4> <textarea class="formE form-control border-3" name="comments" rows="2" cols="40"></textarea><br>
        <button type="submit" class="button2"name="action" value="add">Submit</button>
      </form>
      EOD;
      echo $str;
    }

    function editForm($number){
      $room = new Room($number);
      $str = <<<EOD
      <div class="container">
      <h1>Edit Room</h1>
      <form method="POST">
        <h4 class="words">Room<br>Number</h4> <input class="formE form-control border-3" type="text" name="number" value="$room->number" required><br>
        <h4 class="words">Type</h4>
        <select class="formE form-control border-3" name="type" value="$room->type" required>
          <option value="single">Single</option>
          <option value="double">Double</option>
          <option value="triple">Triple</option>
          <option value="family">Family</option>
          <option value="suite">Suite</option>
        </select><br>
        <h4 class="words">Status</h4>
        <select class="formE form-control border-3" name="status" value="$room->status" required>
          <option value="available">Available</option>
          <option value="unavailable">Unavailable</option>
        </select><br>
        <h4 class="words">Comments</h4> <textarea class="formE form-control border-3" name="comments" rows="2" cols="80">$room->comments</textarea><br>
        <button type="submit"class="button2" name="action" value="edit">Submit</button>
      </form>
      EOD;
      echo $str;
    }

    private function getClass($status){
      switch ($status) {
        case 'available':
          return "success";
          break;
        case 'unavailable':
          return "danger";
          break;
        case 'booked':
          return "primary";
          break;
        case 'checked_out':
          return "warning";
          break;
      }
    }

    private function getTitle($room){
      $status=$room->status;
      switch ($status) {
        case 'available':
          return "Free Room";
          break;
        case 'unavailable':
          return "Unavailable Room";
          break;
        case 'booked':
          $reservation = $room->getReservation();
          return "$reservation[first_name] $reservation[last_name]";
          break;
        case 'checked_out':
          return "Checked out";
          break;
      }
    }

    function checkout(){
      $resRooms = $this->model->getResTypes($_GET['id']);
      $str = <<<EOD

      EOD;
      echo $str;
    }

  }

?>
<style media="screen">
.card{
  cursor: pointer;
}
</style>
<script type="text/javascript">
  function view_room(id){
    window.location.href = "rooms.php?action=view_room&id="+id;
  }
  function mark_available(id){
    window.location.href = "rooms.php?action=mark_available&id="+id;
  }
  function mark_unavailable(id){
    window.location.href = "rooms.php?action=mark_unavailable&id="+id;
  }
  function checkout(id){
    window.location.href = "bills.php?action=checkoutview&id="+id;
  }
</script>
