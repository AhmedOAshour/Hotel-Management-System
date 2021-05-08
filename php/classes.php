<?php
abstract class Database_Handler{
  public $conn;
  function create_connection(){
      $this->conn = new mysqli("localhost", "root", "", "hotel");
  }
  function close_connection(){
      $this->conn->close();
  }
  abstract function insert($fields);
  abstract function update($fields);
 abstract function delete($fields);
  abstract function by_id($id);
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
    $this->create_connection();
    $sql="INSERT into reservation(client_id,guest_names,guest_count,room_no,arrival,departure,comments) values($fields[client_id],'$this->guest_names','$this->guest_count',$fields[room_no],'$this->arrival','$this->departure','$this->comments')";
    $result=mysqli_query($this->conn,$sql);
    $this->close_connection();
    return mysqli_insert_id($this->conn);
  }
  function display(){

  }
  function delete($fields){


  }
  function update($fields){


  }
  function by_id($id){


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
function by_id($id){


}
  function getbyID($id){
    $SQL="select * from client where ID=$id";
    $this->create_connection();
    $result=mysqliquery($this->conn,$SQL);
    $row=mysqli_fetch_array($result);
    $this-> id=$row[0];
    $this->first_name=$row[1];
    $this->last_name=$row[2];
    $this->nationality=$row[3];
    $this->mobile=$row[4];
    $this->email=$row[5];
    $this->company=$row[6];
    $this->close_connection();
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

abstract class User
{
  public $id, $first_name , $last_name, $username, $password, $position;
  //abstract function change_password($password,$Cpassword,$Opassword);
  // abstract function login($username,$password);
  public $conn;
  function create_connection(){
      $this->conn = new mysqli("localhost", "root", "", "hotel");
  }

}
class admin extends User{
  function create_employee($fields){
    $this->create_connection();
    $sql = "INSERT INTO user (username,first_name,last_name,password,position) VALUES ('$fields[username]','$fields[first_name]','$fields[last_name]','$fields[password]','$fields[position]')";
    $result=mysqli_query($this->conn,$sql);
    $this->close_connection();
  }

      function display_employee(){
      $this->create_connection();
        $sql = "SELECT * FROM user";
        $result=mysqli_query($this->conn,$sql);
        return $result;


      }
      function delete_employee($id){
        $this->create_connection();
        $sql = "DELETE FROM user WHERE ID = $id ";
  $result = mysqli_query($this->conn,$sql);
      }
      function update_employee($fields){
        $this->create_connection();
        $sql = "UPDATE user SET first_name = " . "'$fields[first_name]'" . ", last_name = " . "'$fields[last_name]'" . ", password = " . "'$fields[password]'" . ", position = " . "'$fields[position]'" . ", username = " . "'$fields[username]'" . " WHERE ID = '$fields[id]'";
        $result = mysqli_query($this->conn,$sql);



      }
      function by_id($id){
        $this->create_connection();
        $sql = "SELECT * FROM user WHERE id = $id";
        $result=mysqli_query($this->conn,$sql);
        return $result;

      }
      function login($username,$password){
        $this->create_connection();
        $sql="SELECT * from user where username='$username'and password='$password'";
        $result=mysqli_query($this->conn,$sql);
        return $result;
      }


  function display(){
    $this->create_connection();
    $sql = "SELECT * FROM user";
    $result=mysqli_query($this->conn,$sql);
    $this->close_connection();
    return $result;
  }

  function delete($id){
    $this->create_connection();
    $sql = "DELETE FROM user WHERE ID = $id ";
    $result = mysqli_query($this->conn,$sql);
    $this->close_connection();
  }

  function update($fields){
    $this->create_connection();
    $sql = "UPDATE user SET first_name = " . "'$fields[first_name]'" . ", last_name = " . "'$fields[last_name]'" . ", password = " . "'$fields[password]'" . ", position = " . "'$fields[position]'" . ", username = " . "'$fields[username]'" . " WHERE ID = '$fields[id]'";
    $result = mysqli_query($this->conn,$sql);
    $this->close_connection();
  }


}

class Front_Office extends User{


  function login($username,$password){
    $this->create_connection();
    $sql="SELECT * from user where username='$username'and password='$password'";
    $result=mysqli_query($conn,$sql);
    return $result;
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
<<<<<<< HEAD
=======

class HK extends User{
  function login($username,$password){
    $this->create_connection();
    $sql="SELECT * from user where username='$username'and password='$password'";
    $result=mysqli_query($this->conn,$sql);
    return $result;
  }


}


>>>>>>> 5a0ff36e63939dc4426b94ff5961c330ac5d581e
?>
