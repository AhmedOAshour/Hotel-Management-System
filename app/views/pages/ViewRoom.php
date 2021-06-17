<?php
  class ViewRoom extends View
  {
    function output(){
      $str = <<<EOD
        <div class="container">
            <div class="row">
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
            <div class="row">
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
        EOD;
        // make a function for each display type?
        foreach ($rooms as $room) {
          $class = $this->getClass($room->status);
          $title = $this->getTitle($room);
          $str .= <<<EOD
                        <div onclick="alert($room->number)" class="card text-black bg-$class mb-3" style="max-width: 15rem;">
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
        EOD;
      }

//<a class="nostyle" href="#"><a>
      $str .= <<<EOD
            </div>
        </div>
EOD;
echo $str;
    }

    private function getClass($status){
      $class;
      switch ($status) {
        case 'available':
          $class = "success";
          break;
        case 'unavailable':
          $class = "danger";
          break;
        case 'booked':
          $class = "primary";
          break;
        case 'checked_out':
          $class = "warning";
          break;
      }
      return $class;
    }

    private function getTitle($room){
      $status=$room->status;
      $title;
      switch ($status) {
        case 'available':
          $title = "Free Room";
          break;
        case 'unavailable':
          $title = "Unavailable Room";
          break;
        case 'booked':
          $reservation = $room->getReservation();
          $title = "$reservation[first_name] $reservation[last_name]";
          break;
        case 'checked_out':
          $title = "Checked out";
          break;
      }
      return $title;
    }
  }

?>
<style media="screen">
.card{
  cursor: pointer;
}
</style>
