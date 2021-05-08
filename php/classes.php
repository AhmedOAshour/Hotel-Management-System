<?php
abstract class Database_Handler{
  function create_connection(){
      return new mysqli("localhost", "root", "", "hotel");
  }
  function close_connection($conn){
      $conn->close();
  }
  abstract function insert($fields);
  abstract function update($fields);
 abstract function delete($fields);
  //abstract function by_id($id);
  abstract function by_data($fields);
  abstract function display();
  }

class reservation extends Database_Handler{
  public $id;
  public $guest_names;
  public $guest_count;
  public $price;
  public $arrival;
  public $departure;
  public $comments;

  function by_data($fields) {
      $fields = [
        "guest_names" => $this->guest_names,
        "guest_count"=>$this->guest_count,
        "arrival"=>$this->arrival,
        "departure"=> $this->departure,
      ];
    // $this->id=$id;
      $this->guest_names=$guest_names;
      $this->guest_count=$guest_count;
     // $this->price=$price;
      $this->arrival=$arrival;
      $this->departure=$departure;
      $this->comments=$comments;
  }
  function insert($fields){
    $conn=parent::create_connection();
    $sql="INSERT into reservation(client_id,guest_names,guest_count,room_no,arrival,departure,comments) values($fields[client_id],'$this->guest_names','$this->guest_count',$fields[room_no],'$this->arrival','$this->departure','$this->comments')";
    $result=mysqli_query($conn,$sql);
    return mysqli_insert_id($conn);
  }
  function display(){

  }
  function delete($fields){

    
  }
  function update($fields){


  }
}

class client extends Database_Handler{
  public $id;
  public $first_name;
  public $last_name;
  public $nationality;
  public $mobile;
  public $email;
  public $company;
  function __construct($id){
    $this->id=$id;
  }
  function insert($fields){

  }
  function by_data($fields){


  }
function display(){


}
function delete($fields){


}
function update($fields){

    
}
  function getbyID($id){
    $SQL="select * from client where ID=$id";
    $conn=parent::create_connection();
    $result=mysqliquery($conn,$SQL);
    $row=mysqli_fetch_array($result);
    $this-> id=$row[0];
    $this->first_name=$row[1];
    $this->last_name=$row[2];
    $this->nationality=$row[3];
    $this->mobile=$row[4];
    $this->email=$row[5];
    $this->company=$row[6];
    parent::close_connection($conn);
  }

  function insertintoDB($id,$first_name,$last_name,$nationality,$mobile,$email,$company){
    $this-> id=$id;
    $this->first_name=$first_name;
    $this->last_name=$last_name;
    $this->nationality=$nationality;
    $this->mobile=$mobile;
    $this->email=$email;
    $this->company=$company;

  }
}

abstract class User extends Database_Handler
{
  public $id, $first_name , $last_name, $username, $password, $position;
  //abstract function change_password($password,$Cpassword,$Opassword);
  // abstract function login($username,$password);
  
  
}
class admin extends User{
  function insert($fields){
    $conn=parent::create_connection();
    $sql = "INSERT INTO user (username,first_name,last_name,password,position) VALUES ('$fields[username]','$fields[first_name]','$fields[last_name]','$fields[password]','$fields[position]')";
    $result=mysqli_query($conn,$sql);
    echo $sql;

  }
  function by_data($fields){
     $this->first_name=$fields['first_name'];
     $this->last_name=$fields['last_name'];
     $this->username=$fields['username'];
     $this->password=$fields['password'];
     $this->position=$fields['position'];
    
   }
      function display(){
        $conn=parent::create_connection();
        $sql = "SELECT * FROM user";
        $result=mysqli_query($conn,$sql);
        return $result;


      }
      function delete($id){
        $conn=parent::create_connection();
        $sql = "DELETE FROM user WHERE ID = $id ";
  $result = mysqli_query($conn,$sql);
      }
      function update($fields){
        $sql = "UPDATE user SET username = '$fields[username]', password = '$fields[password]', position = '$fields[position]'";
  $result = mysqli_query($con,$sql);
    
      }


}

class Front_Office extends User{
  function by_data($fields){


  }
  function insert($fields){


  }
  function display(){


  }
  function delete($fields){


  }
  function update($fields){

    
  }
  function create_reservation($client_id,$room_no,$guest_names,$guest_count,$arrival,$departure,$comments){
      $reservation=new reservation($guest_names,$guest_count,$arrival,$departure,$comments);

     $fields = [
          "client_id" => $client_id,
          "room_no"=>$room_no
      ];
      $reservation->insert($fields);
  }

  function cancel_reservation($id){

  }

  function edit_reservation($id){

  }

  function create_malfunction_entry($description,$isArchived,$entry_by,$string){

  }

  function create_electricity_followup_entry($reading,$photo){

  }

  function create_water_followup_entry($reading,$photo){
  }
}


?>
