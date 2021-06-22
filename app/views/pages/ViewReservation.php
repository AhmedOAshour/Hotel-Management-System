      <style>
          .sidebar{
              background-color:white;
              width:100%;
              height:45px;
              margin:0;
              padding-top:10px;
          }
          .bar{
              text-align:left;
          }
          .errors{
            color:red;
            position: relative;
            left:270px;
          }
      </style>
      <?php
      class ViewReservation extends View{
      public function output($checkin){
        $date = date('Y-m-d');
        $nextdate = date('Y-m-d',strtotime($date."+7 days"));
        $dateform = "";
        if (!$checkin) {
          $dateform = <<<EOD
          <div class="col-6 bar">
          <form>
          <label>From: </label><input onchange="searchReservation()" type="date" id="date" name="from" class="date" value="$date">
          <label>To: </label><input onchange="searchReservation()" type="date" id="date" name="to" class="date" value="$nextdate">
          </form>
          </div>
          EOD;
        }
        $str=<<<EOD
            <div class="container">
            <div class="row sidebar">
                $dateform
            </div>
          </div>
      EOD;
          $thead;
          if(!$checkin)
          {
            $thead = "<th style='text-align:center'><strong>Edit Reservation</strong></th>
            <th style='text-align:center'><strong>Delete Reservation</strong></th>
            <th style='text-align:center'><strong>View Bill</strong></th>
            ";
          }
          else {
            $thead = "<th style='text-align:center'><strong>Checkin</strong></th>";
          }
          $str.=<<<EOD
              <div class="container">
              <h1>Reservations</h1>
              <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
              <thead>
                  <tr>
                  <th style='text-align:center'><strong>First Name</strong></th>
                  <th style='text-align:center'><strong>Last Name</strong></th>
                  <th style='text-align:center'><strong>Nationality</strong></th>
                  <th style='text-align:center'><strong>Number of Rooms</strong></th>
                  <th style='text-align:center'><strong>Arrival</strong></th>
                  <th style='text-align:center'><strong>Days/Nights</strong></th>
                  $thead
                  </tr>
              </thead>
              <tbody id="rTable">
              EOD;
              $str .= $this->table($checkin,$date,$nextdate);

          $str.=<<<EOD
              </tbody>
              </table>
              </body>
              </html>
          EOD;

      $str.=<<<EOD
      <form>
              <button type="submit" name="action" class="button2"value="createReservation">Create Reservation </button>
              </form>
              </div>
      EOD;

      echo $str;
      }

      public function table($checkin,$from,$to){
        $result=$this->model->readReservations($checkin,$from,$to);
        $str = <<<EOD
        EOD;
        if(!empty($result)){
          while($row = mysqli_fetch_array($result)) {
            $str.=<<<EOD
                <tr>
                <td style='text-align:center'>$row[first_name]</td>
                <td style='text-align:center'>$row[last_name]</td>
                <td style='text-align:center'>$row[nationality]</td>
                <td style='text-align:center'>$row[number_of_rooms]</td>
                <td style='text-align:center'>$row[arrival]</td>
            EOD;
            $arrival = strtotime($row['arrival']);
            $departure = strtotime($row['departure']);
            // divide seconds by 86400 to get nights
            $nights = ($departure - $arrival) / (86400);
            $days = $nights + 1;
            $str.= <<<EOD
                <td style='text-align:center'>$days/$nights</td>
            EOD;
            $buttons;
            if (!$checkin) {
              $buttons = <<<EOD
                <td style='text-align:center '><a class="color" href='reservations.php?action=edit&id=$row[RID]&quantity=$row[number_of_rooms]'><i class='fa fa-edit'></i></a></td>
                <td style='text-align:center '><a class="color" href='reservations.php?action=delete&id=$row[RID]'><i class='fa fa-trash'></i></a></td>
                <td style='text-align:center '><a class="color" href='bills.php?&action=read&id=$row[bill_ID]'><i class="fa fa-eye"></i></a></td>
              EOD;
            }
            else {
              $buttons = <<<EOD
                <td style='text-align:center '><a class="color" href='rooms.php?action=checkin&id=$row[RID]'><i class="fa fa-check-square"></i></a></td>
              EOD;
            }
            $str .= $buttons;
          }
        }
        else {
          $str .= <<<EOD
          <tr><td>No Results</td><tr>
          EOD;
        }
        return $str;
      }

      public function editForm($id,$quantity){
        $number_of_rooms="";
        $room_type="";
        $arrival="";
        $departure="";

        if(isset($_SESSION['errors'])){
          $errors=$_SESSION['errors'];

          if(isset($errors['room_type'])){
            $room_type=$errors['room_type'];
          }
          if(isset($errors['departure'])){
          $departure=$errors['departure'];
          }
          if(isset($errors['arrival'])){
            $arrival=$errors['arrival'];
          }
            if(isset($errors['number_of_rooms'])){
              $number_of_rooms=$errors['number_of_rooms'];
          }
        }
        unset($_SESSION['errors']);

        if(!isset($_SESSION['CID'])){
        $_SESSION['CID']=$id;
        }
        if(!isset($_SESSION['quantity'])){
          $_SESSION['quantity']=$quantity;
        }
        $reservations=new Reservation($id);
        $roomtypes=$this->model->getRoomTypes();
          $str=<<<EOD
                      <div class="container">
                      <div id="reservation">
                      <h1>EditReservation</h1>
                      <form>
                      <h4 class="words nu">Number<br>of Rooms</h4>
                      <h5 class="errors">$number_of_rooms</h5>
                      <input type="number"size="1" class="formE form-control border-3" name="quantity" id="counter" value=1></input>
                      <input type="text" name="id" value="$_SESSION[CID]" class="formE form-control border-3" id="id" hidden>
                      <button type="submit" class="button3" name="action" value="edit">Add</button>
                      </form>
                      <form>
                      <h4 class="words" for="room_type">Room Type</h4>
                      <h5 class="errors">$room_type</h5>
                      $room_type
                      EOD;
                      for($i=0;$i<$_SESSION['quantity'];$i++){
                        $str.=<<<EOD
                        <select class="formE form-control border-3" name="room_type[]">
                        EOD;
                        foreach ($roomtypes as $room) {
                          $str.=<<<EOD
                            <option value='$room'>$room</option>
                          EOD;
                        }
                      $str.=<<<EOD
                          </select><br>
                      EOD;
                      }
            $date = date('Y-m-d');
            $nextdate = date('Y-m-d',strtotime($date."+1 days"));
            $str.=<<<EOD
            </select>
            <h4 class="words arr">Arrival</h4><input type='date' value="$date" min="$date" class="formE form-control border-3"value='$reservations->arrival'name='arrival' required>
            <h5 class="errors">$arrival</h5>
            <h4 class="words">Departure</h4> <input type='date'
            value="$nextdate" min="$nextdate" class="formE form-control border-3"value='$reservations->departure' name='departure' required><br>
            <h5 class="errors">$departure</h5>
            <h4 class="words">Comments</h4><textarea name="comments"  rows="2" cols="50" class="formE form-control border-3"placeholder="Comments..." >$reservations->comments</textarea> <br>
            <input type="text" name="client_ID" value="$reservations->client_id"  id="client_ID" hidden>
            <input type="text" name="id" value="$_SESSION[CID]"  id="ID" hidden>
            <input type="text" name="quantity" value="$_SESSION[quantity]"  id="quantity" hidden>
            <button type="submit" name="action" class="button2" value="editRes">Edit Reservation </button>
            </form>
            </div>
            </div>
            </body>
            </html>
            EOD;
            echo $str;
            unset($_SESSION['CID']);
            unset($_SESSION['quantity']);
      }
      }




      ?>
