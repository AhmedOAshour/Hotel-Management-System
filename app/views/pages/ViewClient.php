<?php
class ViewClient extends View{
    public function output(){
        $clients=$this->model->readClients();
     
      
        $str = 
        <<<EOD
        
                    <div id="client">
                    <div id="showClients">
                      <input type="text" id="bar" placeholder="Search by..." oninput="showClient()">
                      <select id="select" onchange="showClient()">
                        <option value="last_name">Last Name</option>
                        <option value="identification_no">ID Number</option>
                        <option value="company">Company</option>
                      </select>
                      <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
                        <thead>
                    <tr>
                <th><strong>First Name</strong></th>
                <th><strong>Last Name</strong></th>
                <th><strong>Nationality</strong></th>
                <th><strong>Identification No.</strong></th>
                <th><strong>Mobile</strong></th>
                <th><strong>E-mail</strong></th>
                <th><strong>Company</strong></th>
                EOD;
                if(!empty($_GET['flag'])&&$_GET['flag']==true){
                $str.=<<<EOD
                  <th><strong>Create Reservation</strong></th>             
                EOD;
                }
                else {
                $str.=<<<EOD
                  <th><strong>Edit</strong></th>
                  <th><strong>Delete</strong></th>                 
                EOD;

                }
                $str.=
                <<<EOD
                                                                                                                                                </tr>
                                                                                                                                                </thead>
                                                                                                                                                </div>

                
                 EOD;
   
    foreach ($clients as $client) {
        $str .= <<<EOD
                                          <tr>
                                        
                                            <td>$client->first_name</td>
                                            <td>$client->last_name</td>
                                            <td>$client->identification_no</td>
                                            <td>$client->nationality</td>
                                            <td>$client->mobile</td>
                                            <td>$client->email</td>
                                            <td>$client->company</td>
          EOD;
          if(!empty($_GET['flag'])&&$_GET['flag']==true){
            $str.=<<<EOD
          <td><a href="clients.php?action=addfields&id=$client->id">Create Reservation</a></td>
          EOD;
          }
          else { $str.=<<<EOD
            <td><a href="clients.php?action=editform&id=$client->id">Edit</a></td>
            <td><a href="clients.php?action=delete&id=$client->id">Delete</a></td>
            EOD;


          }
    $str.=<<<EOD
        </tr>
        EOD;
      }
  $str .= <<<EOD
      </tbody>
    </table>
    <br>
  </div>

  <a href="clients.php?action=addform"><button type="button" class="button" id="addBtn">Add Client</button></a>
  EOD;
  echo $str;
    
}
public function addForm(){

    $str=
    <<<EOD
            <div id="createClient">
            <form>
            <input class="formE form-control border-3" type="text" name="first_name" placeholder="First Name...">
            <input class="formE form-control border-3" type="text" name="last_name" placeholder="Last Name...">
            <input class="formE form-control border-3" type="text" name="identification_no" placeholder="Identification Number...">
            <input class="formE form-control border-3" type="text" name="nationality" placeholder="Nationality...">
            <input class="formE form-control border-3" type="text" name="mobile" placeholder="Mobile...">
            <input class="formE form-control border-3" type="text" name="email" placeholder="E-mail...">
            <input class="formE form-control border-3" type="text" name="company" placeholder="Company...">
            <input type="submit" class="create" name="action" value="add" id="submitBtn"">
            </form>
            </div>
        </div>

    EOD;
echo $str;

}
public function resForm($id,$quantity){

  $roomtypes=$this->model->getRoomType();

 
  $str=
  <<<EOD
              <div id="reservation">
              <form>
              <input id="count" type='text' name='guest_count' placeholder="Guest Count"><br>
              <textarea name="guest_names" rows="3" cols="23" placeholder="Guest Names seperate by ,"></textarea> <br>
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
        
        
      Arrival: <input type='date' name='arrival'>
      Departure: <input type='date' name='departure'><br>
      <textarea name="comments" rows="8" cols="80" placeholder="Comments..."></textarea> <br>
      <input type="text" name="client_ID" value="$id"  id="client_ID" hidden>
      <input type="text" name="quantity" value="$quantity"  id="quantity" hidden>
      <button type="submit" name="action" value="createRes">Create Reservation</button>
      </form>
      </div>
      </div>
      </body>
      </html>
      EOD;
      echo $str;

}
public function editForm($id){
  $client = new Client($id);
$str=
    <<<EOD
            <div id="createClient">
            <form>
            <input class="formE form-control border-3" type="text" value="$client->first_name" name="first_name" placeholder="First Name...">
            <input class="formE form-control border-3" type="text" name="last_name" value="$client->last_name" placeholder="Last Name...">
            <input class="formE form-control border-3" type="text" name="identification_no" value="$client->identification_no"placeholder="Identification Number...">
            <input class="formE form-control border-3" type="text" name="nationality" value="$client->nationality"placeholder="Nationality...">
            <input class="formE form-control border-3" type="text" name="mobile" value="$client->mobile"placeholder="Mobile...">
            <input class="formE form-control border-3" type="text" name="email" value="$client->email"placeholder="E-mail...">
            <input class="formE form-control border-3" type="text" name="company"value="$client->company" placeholder="Company...">
            <input class="formE form-control border-3" type="text" name="id"value="$id" hidden placeholder="Company...">
            <input type="submit" class="create" name="action" value="edit" id="submitBtn"">
            </form>
            </div>
        </div>

    EOD;
echo $str;


}
public function addFields($id){
  $str=<<<EOD

              <form>
              Number of Rooms:
              <input type="number"size="1" name="quantity" id="counter" value=1></input>
              <input type="text" name="id" id="counter" hidden value=$id></input>
              <button type="submit" class="btn1 inputfile btn w-100 py-3" name="action" value="resform">Proceed</input>
            </form>
         
    EOD;

    echo $str;


      


}
}