<style>
    .add{
        position: relative;
        left:450px;
    }
    .search{
        width:250px;
        border-top: none;
        border-right: none;
        border-left: none;
    }
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
    .searchbar{
        text-align:right;
    }
    .left{
        background-color:#EFEBEB;
        width:230px;
        height:790px;
        position: relative;
        top:15px;
        right:15px;
    }
    .errors{
      color:red;
      position: relative;
      left:270px;
    }
</style>
<?php
class ViewLostAndFound extends View{
public function output(){
   $entries= $this->model->readEntries();
    $str=<<<EOD
      <body>
      <div class="container">
                      <div class="row sidebar">
                          <div class="col-3 bar">
                              <form action="/action_page.php">
                              </form>
                          </div>
                          <div class="col-9 searchbar">
                          <input type="text" id="bar" class="search"placeholder="Search by room number.." oninput="showClient()"><i class="fa fa-search"></i>
                          </div>
                      </div>
                  </div>
      <div class="container ">
      <h1>Lost&Found</h1>
          <table>
              <thead>
                  <tr>
                      <th style='text-align:center'><strong>Date</strong></th>
                      <th style='text-align:center'><strong>Room Number</strong></th>
                      <th style='text-align:center'><strong>Description</strong></th>
                      <th style='text-align:center'><strong>Entry By</strong></th>
                  </tr>

EOD;
if ($entries) {
  foreach ($entries as $entry) {
    $str .= <<<EOD
    <tr>
    <td style='text-align:center'>$entry->date</td>
    <td style='text-align:center'>$entry->room_number</td>
    <td style='text-align:center'>$entry->item_description</td>
    <td style='text-align:center'>$entry->HK_Username</td>
    EOD;
  }
}
else {
  $str.=<<<EOD
  <tr><td>No Results<td><tr>
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
    <br>
    <button type="submit" name="action" value="addform" class="button add">Add a new entry</button>
    </form>
    EOD;
    echo $str;
}
public function addForm($username){
  $room_no="";
    $description="";
  $dates="";
    if(isset($_SESSION['errors'])){
      $errors=$_SESSION['errors'];
    
     
        if(isset($errors['date'])){
            $dates=$errors['date'];
                                    }
          if(isset($errors['room_number'])){
            $room_no=$errors['room_number'];
                  }
            if(isset($errors['item_description'])){
                    $description=$errors['item_description'];
                                             }
             
  
  
    }
  unset($_SESSION['errors']);
    $rooms=new Room();
    $numbers=$rooms->readRooms();
    $date=date('Y-m-d');
    $str=<<<EOD
    <body>
      <div class="container">
        <form>
          <div class="form">
            <h1 class="head">Lost and Found</h1>
            <input type="date" value="$date" class="formE form-control mb-1 py-4 " name="date" required><br>
            <h5 class="errors">$dates</h5>
            <select class="formE form-control mb-1 " name="room_number">
EOD;
  foreach ($numbers as $room) {
    $str.=<<<EOD
    <option value='$room->number'>$room->number</option>
    EOD;
  }

  $str.=<<<EOD
  </select>
  <h5 class="errors">$room_no</h5>
  <input type="text"class="formE form-control mb-1 py-4 " name="username" value="$username" placeholder="username" hidden><br>
  <textarea type="text"class="formE form-control mb-4 "id="fname" name="item_description" placeholder="Description.." required></textarea><br>
  <h5 class="errors">$description</h5>
  <input type="submit"class="button2" value="Add" name="action">
  </div>
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
