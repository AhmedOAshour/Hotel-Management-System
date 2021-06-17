<?php
  class ViewRoom extends View
  {
    function output(){
      $str = <<<EOD
        <div class="container">
            <div class="row sidebar">
                <div class="col-3 bar">
                    <form action="/action_page.php">
                        <label>Date:</label>
                        <input type="date" id="date" name="Date">
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
                        <li><a href="reservations.php?action=checkin"> <button> Check In </button> </a></li>
                        <li><a href="rooms.php?action=manage"> <button> Manage rooms </button> </a></li>
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
        <a href="rooms.php">Back</a> <br>
        room number $room->number<br>
        room type $room->type<br>
        room status $room->status<br>
        comments $room->comments<br><br>
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
            <button onclick="mark_unavailable($_GET[id])"> Mark as Unavailable </button>
          EOD;
          break;
        case 'unavailable'||'checked_out':
          $str .= <<<EOD
            <button onclick="mark_available($_GET[id])"> Mark as Available </button>
          EOD;
          break;
      }
      $str .= <<<EOD
      EOD;
      echo $str;
    }

    function checkin($resID){
      $str = <<<EOD
        $resID
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
.checkin{
  /* display: none; */
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
