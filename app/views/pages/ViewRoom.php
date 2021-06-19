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
  </style>
<?php
  class ViewRoom extends View
  {
    function output(){
      $str = <<<EOD
        <div class="container">
            <div class="row sidebar">
                <div class="col-3 bar">
                    <form action="/action_page.php">
                    </form>
                </div>
                <div class="col-9 searchbar">
                    <input class="search"type="text" placeholder="Search by room or guest's name"><i class="fa fa-search"></i>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row sidebar">
                <div class="col-3">
                    <ul class="nav flex-column left">
                        <h3>Status</h3>
                        <li class="nav-item">
                            <input type="checkbox" id="status1" name="status1" value="Reserved">
                            <label for="vehicle1">Reserved</label><br>
                            <input type="checkbox" id="status2" name="status2" value="Occupied">
                            <label for="vehicle1">Occupied</label><br>
                            <input type="checkbox" id="status3" name="status3" value="Available">
                            <label for="vehicle1">Available</label><br>
                            <input type="checkbox" id="status3" name="status3" value="CheckedOut">
                            <label for="vehicle1">CheckedOut</label><br>
                        </li>
                        <h3>Type</h3>
                        <li class="nav-item">
                            <input type="checkbox" id="Type1" name="Type1" value="Single">
                            <label for="vehicle1">Single</label><br>
                            <input type="checkbox" id="Type2" name="Type2" value="Double">
                            <label for="vehicle1">Double</label><br>
                            <input type="checkbox" id="Type3" name="Type3" value="Triple">
                            <label for="vehicle1">Triple</label><br>
                            <input type="checkbox" id="Type3" name="Type3" value="Family">
                            <label for="vehicle1">Family</label><br>
                        </li>
                        <h3>House Keeping</h3>
                        <li class="nav-item">
                            <input type="checkbox" id="HouseKeeping1" name="HouseKeeping1" value="Clean">
                            <label for="vehicle1">Clean</label><br>
                            <input type="checkbox" id="HouseKeeping2" name="HouseKeeping2" value="Notclean">
                            <label for="vehicle1">Not clean</label><br>
                            <input type="checkbox" id="HouseKeeping3" name="HouseKeeping3" value="Inprogress">
                            <label for="vehicle1">In progress</label><br>
                        </li>
                        <li><a href="reservations.php?action=checkin"> <button class="button5"> Check In </button> </a></li>
                        <li><a href="rooms.php?action=manage"> <button class="button5"> Manage rooms </button> </a></li>
                    </ul>
                </div>
                <div class="col-9">
      EOD;
      $types = $this->model->getRoomTypes();
      foreach ($types as $type) {
        $rooms = $this->model->readRooms("$type");
        $str .= <<<EOD
          <div class="col-9">
            <h3 class="title">$type</h3>
            <div class="row">
        EOD;
        // make a function for each display type?
        foreach ($rooms as $room) {
          $class = $this->getClass($room->status);
          $title = $this->getTitle($room);
          $str .= <<<EOD
                        <div onclick="view_room($room->number)" class="card text-black bg-$class mb-3 mx-3" style="width: 15rem;">
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
          </div>
        </div>
        <br>
        <a href="rooms.php"><button class="button2">Back</button></a><br>
      EOD;
      switch ($room->status) {
        case 'booked':
          $res = $room->getReservation();
          $str .= <<<EOD
          guest names $res[guest_names] <br>
          arrival $res[arrival]<br>
          departure $res[departure]<br>
          check in $res[check_in]<br>
          comments $res[comments]<br>
          first_name $res[first_name]<br>
          last_name $res[last_name]<br>
          Identification Number $res[identification_no]<br>
          Nationality $res[nationality]<br>
          mobile $res[mobile]<br>
          email $res[email]<br>
          company $res[company]<br>
          <button onclick="checkout($_GET[id])"> Check out </button>
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
      <form action="rooms.php" method="POST">
      EOD;
      $resRooms = $this->model->getResTypes($_GET['id']);
      foreach ($resRooms as $key => $type) {
        $str .= <<<EOD
          <label>$type</label>
          <select class="" name="rooms[]">
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
        <input type="text" name='id' value=$_GET[id] style="display:none">
        <button type='submit' name='action' value='checkedin'> Checkin </button>
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
      <a href="rooms.php?action=addform"><button class="button2">Add a Room</button></a><br>
      EOD;
      echo $str;
    }

    function addForm(){
      $str = <<<EOD
      <div class="container">
      <h1>Add Room</h1>
      <form method="POST">
        <h4 class="words">Room<br>Number</h4> <input class="formE form-control border-3" type="text" name="number" required><br>
        <h4 class="words">Type</h4>
        <select name="type" class="formE form-control border-3" required>
          <option value="single">Single</option>
          <option value="double">Double</option>
          <option value="triple">Triple</option>
          <option value="family">Family</option>
          <option value="suite">Suite</option>
        </select><br>
        <h4 class="words">Status</h4>
        <select name="status" class="formE form-control border-3" required>
          <option value="available">Available</option>
          <option value="unavailable">Unavailable</option>
        </select><br>
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
    window.location.href = "rooms.php?action=checkout&id="+id;
  }
</script>
