<?php

class ViewReservation extends View{
public function output(){
$result=$this->model->readReservations();

    $str=<<<EOD
        <input type="date" id="date" value="<?php echo date('Y-m-d'); ?>">
        <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
        <thead>
            <tr>
            <th><strong>First Name</strong></th>
            <th><strong>Last Name</strong></th>
            <th><strong>Nationality</strong></th>
            <th><strong>Number of Rooms</strong></th>
            <th><strong>Arrival</strong></th>
            <th><strong>Days/Nights</strong></th>
            <th><strong>Edit Reservation</strong></th>
            <th><strong>Delete Reservation</strong></th>
            </tr>
        </thead>
        <tbody id="rTable">
        EOD;
        if(!empty($result)){
        while($row = mysqli_fetch_array($result)) {


            $str.=
            <<<EOD
                    <tr>
                    <td>$row[first_name]</td>
                    <td>$row[last_name]</td>
                    <td>$row[nationality]</td>
                    <td>$row[number_of_rooms]</td>
                    <td>$row[arrival]</td>
        EOD;
        $arrival = strtotime($row['arrival']);
        $departure = strtotime($row['departure']);
        // divide seconds by 86400 to get nights
        $nights = ($departure - $arrival) / (86400);
        $days = $nights + 1;
    $str.=
    <<<EOD
        <td>$days/$nights</td>
        <td style='text-align:center '><a href='reservations.php?action=editRoomCount&id=$row[RID]'>Edit</a></td>
        <td style='text-align:center '><a href='reservations.php?action=delete&id=$row[RID]'>Delete</a></td>
        EOD;
    }

    $str.=
    <<<EOD
        </tbody>
        </table>
        </div>
        </body>
        </html>
     EOD;
}
$str.=
<<<EOD
<form>

        <button type="submit" name="action" value="createReservation">Create Reservation </button>
        </form>



EOD;

echo $str;
}

public function editForm($id,$quantity){
$reservations=new Reservation($id);
$roomtypes=$this->model->getRoomType();
$floorno=$this->model->getFloorsNo();

  $str=
  <<<EOD
              <div id="reservation">
              <form>
              <input id="count" type='text' name='guest_count' value='$reservations->guest_count' placeholder="Guest Count"><br>
              <textarea name="guest_names" rows="3" cols="23" placeholder="Guest Names seperate by ,">$reservations->guest_names</textarea> <br>
              <label for="room_type">Room Type:</label>
              EOD;
              for($i=0;$i<$quantity;$i++){
                $str.=<<<EOD
                <select class="" name="room_type[]">
                EOD;
               foreach ($roomtypes as $room) {
             $str.=<<<EOD
               <option value='$room'>$room</option>
             EOD;
             }
             $str.=
             <<<EOD
                </select>
             EOD;



              }




      $str.=
      <<<EOD
      </select>
      Arrival: <input type='date' value='$reservations->arrival'name='arrival'>
      Departure: <input type='date' value='$reservations->departure' name='departure'><br>
      <textarea name="comments"  rows="8" cols="80" placeholder="Comments...">$reservations->comments</textarea> <br>
      <input type="text" name="client_ID" value="$reservations->client_id"  id="client_ID" hidden>
      <input type="text" name="id" value="$_GET[id]"  id="ID" hidden>
      <input type="text" name="quantity" value="$quantity"  id="quantity" hidden>
      <button type="submit" name="action" value="editRes">Edit Reservation </button>
      </form>
      </div>
      </div>
      </body>
      </html>
      EOD;
      echo $str;

}

public function editRoomCount($id){
    $str=<<<EOD
                <form>
                Number of Rooms:
                <input type="number"size="1" name="quantity" id="counter" value=1></input>
                <input type="text" name="id" id="counter" hidden value=$id></input>
                <button type="submit" class="btn1 inputfile btn w-100 py-3" name="action" value="edit">Edit Reservation</button>
              </form>

      EOD;

      echo $str;





  }




}




?>
