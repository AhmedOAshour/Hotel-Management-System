<?php
class ViewLostAndFound extends View{
public function output(){
   $entries= $this->model->readEntries();
    $str=
<<<EOD
                <body>
                <div class="container mt-3">
                    <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
                        <thead>
                            <tr>
                                <th style='text-align:center'><strong>Date</strong></th>
                                <th style='text-align:center'><strong>Room Number</strong></th>
                                <th style='text-align:center'><strong>Description</strong></th>
                                <th style='text-align:center'><strong>Entry By</strong></th>
                            </tr>
                   
EOD;
foreach ($entries as $entry) {
    $str .= <<<EOD
                                      <tr>
                                    
                                        <td>$entry->date</td>
                                        <td>$entry->room_number</td>
                                        <td>$entry->item_description</td>
                                        <td>$entry->HK_Username</td>
                                        
      EOD;
                            }
    $str.=<<<EOD
                     </tr>
                    </thead>
                    <tbody id="rTable">
                    </tbody>
                </table>
                </div>
                </body>
                <form>
                <input type="submit" name="action" value="addform">
                </form>
    EOD;
    echo $str;
}
public function addForm($username){
    $rooms=new Room();
    $numbers=$rooms->readRooms();
$str=
<<<EOD
            <body>
            <div class="online py-100">
                    <div class="container pos">
                        <div class="row">
                            <div class="col-lg">
                                <form>
                                    <div class="form">	
                                        <h1 class="head">Lost and Found</h1>
                                        <input type="date"class="forms form-control mb-1 py-4 " name="date" ><br>
                                        <select class="" name="room_number">
EOD;
                                        foreach ($numbers as $room) {
                                            $str.=<<<EOD
                                            
                                                <option value='$room->number'>$room->number</option>
                                                EOD;
                                                                        }
                                            
                                        $str.=
                                        <<<EOD
                                        
                                        </select>
                                        <input type="text"class="forms form-control mb-1 py-4 " name="username" value="$username" placeholder="username" hidden><br>
                                        <textarea type="text"class="forms form-control mb-4 "id="fname" name="item_description" placeholder="Description.."></textarea><br>
                                        <input type="submit"class="inputfile btn w-100 py-3" value="add" name="action">
                                    </div>
                                </form>
                            </div>
                        </div>	
                    </div>
                </div>
            </body>
            </html>

EOD;
echo $str;


}


}




?>