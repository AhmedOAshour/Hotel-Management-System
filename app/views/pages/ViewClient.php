<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
<style>
  .forgot{
    position: relative;
    left:270px;
    bottom:100px;
    color:#000026;
  }
  .forgot:hover{
    text-decoration:none;
    color:blue;
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
</style>
  </body>
</html>
<?php
class ViewClient extends View{
    public function output(){
        $clients=$this->model->readClients();
        $str =<<<EOD
                      <div class="container">
                      <div class="row sidebar">
                          <div class="col-3 bar">
                              <form action="/action_page.php">
                              </form>
                          </div>
                          <div class="col-9 searchbar">
                          <input type="text" id="bar" class="search"placeholder="Search by name, company, etc." oninput="showClient()"><i class="fa fa-search"></i>
                          </div>
                      </div>
                  </div>
                    <div class="container">
                    <h1>Create Reservation</h1>
                    <div id="client">
                    <div id="showClients">
                      <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
                        <thead>
                    <tr>
                <th style='text-align:center'><strong>First Name</strong></th>
                <th style='text-align:center'><strong>Last Name</strong></th>
                <th style='text-align:center'><strong>Nationality</strong></th>
                <th style='text-align:center'><strong>Identification No.</strong></th>
                <th style='text-align:center'><strong>Mobile</strong></th>
                <th style='text-align:center'><strong>E-mail</strong></th>
                <th style='text-align:center'><strong>Company</strong></th>
                EOD;
                if(!empty($_GET['flag'])&&$_GET['flag']==true){
                $str.=<<<EOD
                  <th style='text-align:center'><strong>Create Reservation</strong></th>
                EOD;
                }
                else {
                $str.=<<<EOD
                  <th style='text-align:center'><strong>Edit</strong></th>
                  <th style='text-align:center'><strong>Delete</strong></th>
                EOD;
                }
                $str.=
                <<<EOD
                    </tr>
                    </thead>
                    </div>
                 EOD;
   if ($clients) {
     foreach ($clients as $client) {
       $str .= <<<EOD
       <tr>
       <td style='text-align:center'>$client->first_name</td>
       <td style='text-align:center'>$client->last_name</td>
       <td style='text-align:center'>$client->identification_no</td>
       <td style='text-align:center'>$client->nationality</td>
       <td style='text-align:center'>$client->mobile</td>
       <td style='text-align:center'>$client->email</td>
       <td style='text-align:center'>$client->company</td>
       EOD;
       if(!empty($_GET['flag'])&&$_GET['flag']==true){
         $str.=<<<EOD
         <td style='text-align:center'><a class="color"href="clients.php?action=resform&id=$client->id&quantity=1"><i class='fa fa-plus-square'></i></a></td>
         EOD;
       }
       else { $str.=<<<EOD
         <td style='text-align:center'><a class="color" href="clients.php?action=editform&id=$client->id"><i class='fa fa-edit'></i></a></td>
         <td style='text-align:center'><a class="color" href="clients.php?action=delete&id=$client->id"><i class='fa fa-trash'></i></a></td>
         EOD;
       }
       $str.=<<<EOD
       </tr>
       EOD;
     }
   }
   else {
     $str.=<<<EOD
     <tr><td>No Results</td></tr>
     EOD;
   }
  $str .= <<<EOD
      </tbody>
    </table>
    <br>
  </div>
  </div>
  <a href="clients.php?action=addform"><button type="button" class="button2" id="addBtn">Add Client</button></a>
  EOD;
  echo $str;

}
public function addForm(){

  $email="";
  $fname="";
  $lname="";
  $mobile="";
  $nationality="";
  $company="";
  $idn="";

  if(isset($_SESSION['errors'])){
    $errors=$_SESSION['errors'];
   
    if(isset($errors['fname'])){
      $fname=$errors['fname'];
                                }
    if(isset($errors['email'])){
    $email=$errors['email'];

    }
    
    if(isset($errors['lname'])){
       $lname=$errors['lname'];
                                }
    if(isset($errors['id'])){
        $idn=$errors['id'];
                             }
    if(isset($errors['nationality'])){
        $nationality=$errors['nationality'];
                            }
      if(isset($errors['mobile'])){
          $mobile=$errors['mobile'];
                                  }
        if(isset($errors['company'])){
          $company=$errors['company'];
                }


  }
unset($_SESSION['errors']);

    $str=
    <<<EOD
        <div class="container">
        <div id="createClient">
        <h1>Add client</h1>
        <form>
        <input class="formE form-control border-3" type="text" name="first_name" id="Fname" onchange="checkfName()" placeholder="First Name..." required>
        $fname
        <div id="errorName1">
        
        </div>
        <input class="formE form-control border-3" type="text" name="last_name" id="Lname" onchange="checklName()" placeholder="Last Name..."required>
        $lname
        <div id="errorName2">
        
        </div>
        <input class="formE form-control border-3" type="text" name="identification_no" placeholder="Identification Number..." required>
        $idn
        <input class="formE form-control border-3" type="text" name="nationality" placeholder="Nationality..." required>
        $nationality
        <input class="formE form-control border-3" type="text" name="mobile" id="mobile" onchange="checkMobile()" placeholder="Mobile..." required>
        <div id="errorMobile">
        $mobile
        </div>
        <input class="formE form-control border-3" type="text" name="email" id="email" onchange="checkEmail()" placeholder="E-mail..." required>
        <div id="errorEmail">
        $email
        </div>
        <input class="formE form-control border-3" type="text" name="company" placeholder="Company..."required>
        $company
        <input type="submit" class="button2" name="action" value="Add" id="submitBtn"">
        </form>
        </div>
    </div>
    </div>
    EOD;
echo $str;

}
public function resForm($id,$quantity){
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
  $roomtypes=$this->model->getRoomTypes();
  $date = date('Y-m-d');
  $nextdate = date('Y-m-d',strtotime($date."+1 days"));
  $str=<<<EOD
      <div class="container">
      <div id="reservation">
      <h1>Create Reservation</h1>
      <form>
      <h4 class="words nu">Number<br>of Rooms</h4>
      <input type="number"size="1" class="formE form-control border-3"name="quantity" id="counter" value=1 required></input>
      $number_of_rooms
      <input type="text" name="id" value="$id" class="formE form-control border-3" id="id" hidden>
      <button type="submit" class="button3" name="action" value="resform">Add</button>
      </form>
      <form>
      <h4 class="words" for="room_type">Room Type</h4>
   EOD;
   for($i=0;$i< $_SESSION['quantity'];$i++){
     $str.=<<<EOD
     <select class="formE form-control border-3" name="room_type[]">
     EOD;
    foreach ($roomtypes as $room) {
      $str.=<<<EOD
      <option value='$room'>$room</option>
      EOD;
    }
  $str.= <<<EOD
   </select><br>
   $room_type
  EOD;
   }
    $str.= <<<EOD
      <h4 class="words arr">Arrival</h4><input value="$date" min="$date" type='date'class="formE form-control border-3" name='arrival' required>
      $arrival
      <h4 class="words">Departure</h4> <input type='date' value="$nextdate" min="$nextdate" class="formE form-control border-3" name='departure'required><br>
      $departure
      <textarea class="formE form-control border-3" name="comments" rows="2" cols="50" placeholder="Comments..."></textarea> <br>
      <input type="text" name="client_ID" value="$_SESSION[CID]" class="formE form-control border-3" id="client_ID" hidden>
      <input type="text" name="quantity" value="$_SESSION[quantity]" class="formE form-control border-3" id="quantity" hidden>
      <button type="submit" name="action" class="button2"value="createRes">Create Reservation</button>
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
public function editForm($id){
  
  $email="";
  $fname="";
  $lname="";
  $mobile="";
  $nationality="";
  $company="";
  $idn="";

  if(isset($_SESSION['errors'])){
    $errors=$_SESSION['errors'];
    
    if(isset($errors['fname'])){
      $fname=$errors['fname'];
                                }
    if(isset($errors['email'])){
    $email=$errors['email'];

    }
    
    if(isset($errors['lname'])){
       $lname=$errors['lname'];
                                }
    if(isset($errors['id'])){
        $idn=$errors['id'];
                             }
    if(isset($errors['nationality'])){
        $nationality=$errors['nationality'];
                            }
      if(isset($errors['mobile'])){
          $mobile=$errors['mobile'];
                                  }
        if(isset($errors['company'])){
          $company=$errors['company'];
                }


  }
unset($_SESSION['errors']);


  $client = new Client($id);
  if(!isset($_SESSION['CID'])){
$_SESSION['CID']=$id;

  }

  $str=<<<EOD
            <div class="container">
            <h1>Edit Clients</h1>
            <form>
            <h5 class="words">First Name</h5><input class="formE form-control border-3" type="text" id="Fname" onchange="checkfName()" value="$client->first_name" name="first_name"  required>
            <div id="errorFName">
            $fname
            </div>
            <h5 class="words">Last Name</h5><input class="formE form-control border-3" type="text" name="last_name" id="Lname" onchange="checklName()" value="$client->last_name" required>
            <div id="errorLName">
            $lname
            </div>
            <h5 class="words down">Identification<br>number</h5><input class="formE form-control border-3" type="text" name="identification_no" value="$client->identification_no" required>
            $idn
            <h5 class="words">Nationality</h5><input class="formE form-control border-3" type="text" name="nationality" value="$client->nationality" required>
            $nationality
            <h5 class="words down">Mobile<br>Number</h5><input class="formE form-control border-3" type="text" name="mobile" id="mobile" onchange="checkMobile()" value="$client->mobile" required>
            $mobile
            <div id="errorMobile">
            </div>
            <h5 class="words">Email</h5><input class="formE form-control border-3" type="text" name="email" id="email" onchange="checkEmail()" value="$client->email" required>
            $email
            <div id="errorEmail">
            </div>
            <h5 class="words">Company</h5><input class="formE form-control border-3" type="text" name="company"value="$client->company"  required>
            $company
            <h5 class="words"></h5><input class="formE form-control border-3" type="text" name="id"value="$_SESSION[CID]" hidden  required>
            <button type="submit" class="button2" name="action" value="edit">Submit</button>
            </form>
        </div>
    EOD;
echo $str;
unset($_SESSION['CID']);

}
}
