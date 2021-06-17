<?php

class ViewReservation extends View{
public function output(){
$result=$this->model->readReservations();

    $str=<<<EOD
        <div class="container">
        <input type="date" id="date" value="<?php echo date('Y-m-d'); ?>">
        <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
        <thead>
            <tr>
            <th style='text-align:center'><strong>First Name</strong></th>
            <th style='text-align:center'><strong>Last Name</strong></th>
            <th style='text-align:center'><strong>Nationality</strong></th>
            <th style='text-align:center'><strong>Number of Rooms</strong></th>
            <th style='text-align:center'><strong>Arrival</strong></th>
            <th style='text-align:center'><strong>Days/Nights</strong></th>
            <th style='text-align:center'><strong>Edit Reservation</strong></th>
            <th style='text-align:center'><strong>Delete Reservation</strong></th>
            </tr>
        </thead>
        <tbody id="rTable">
        EOD;
        if(!empty($result)){
        while($row = mysqli_fetch_array($result)) {


            $str.=
            <<<EOD
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
    $str.=
    <<<EOD
        <td style='text-align:center'>$days/$nights</td>
        <td style='text-align:center '><a class="color" href='reservations.php?action=edit&id=$row[RID]&quantity=$row[number_of_rooms]'><i class='fa fa-edit'></a></td>
        <td style='text-align:center '><a class="color" href='reservations.php?action=delete&id=$row[RID]'><i class='fa fa-trash'></i></a></td>
        EOD;
    }

    $str.=
    <<<EOD
        </tbody>
        </table>


        </body>
        </html>
     EOD;
}
$str.=
<<<EOD
<form>

        <button type="submit" name="action" class="button2"value="createReservation">Create Reservation </button>
        </form>
        </div>


EOD;

echo $str;
}

public function editForm($id,$quantity){
$reservations=new Reservation($id);
$roomtypes=$this->model->getRoomTypes();

  $str=
  <<<EOD
                <div class="container">
              <div id="reservation">
              <h1>Edit Reservations</h1>
              <form>
              <h4 class="words" for="room_type">Room Type</h4>
              EOD;
              for($i=0;$i<$quantity;$i++){
                $str.=<<<EOD
                <select class="formE form-control border-3" name="room_type[]">
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
      <h4 class="words arr">Arrival</h4><input type='date' class="formE form-control border-3"value='$reservations->arrival'name='arrival'>
      <h4 class="words">Departure</h4> <input type='date' class="formE form-control border-3"value='$reservations->departure' name='departure'><br>
      <h4 class="words">Comments</h4><textarea name="comments"  rows="2" cols="50" class="formE form-control border-3"placeholder="Comments...">$reservations->comments</textarea> <br>
      <input type="text" name="client_ID" value="$reservations->client_id"  id="client_ID" hidden>
      <input type="text" name="id" value="$_GET[id]"  id="ID" hidden>
      <input type="text" name="quantity" value="$quantity"  id="quantity" hidden>
      <button type="submit" name="action" class="button2" value="editRes">Edit Reservation </button>

      </form>
      </div>
      </div>
      </body>
      </html>
      EOD;
      echo $str;

}





}




?>
