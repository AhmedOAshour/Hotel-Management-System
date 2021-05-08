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
  abstract function by_id($id);
  abstract function by_data($fields);
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
}
?>
