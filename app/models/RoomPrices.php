<?php
class RoomPrices extends Model
{
  public $room_type, $price;

  function __construct($room_type=""){
    parent::__construct();
    if ($room_type!="") {
      $sql = "SELECT * FROM room_prices WHERE room_type = '$room_type'";
      $result = $this->db->query($sql);
      if ($result->num_rows == 1){
        $row = $this->db->fetchRow();
        $this->room_type = $row['room_type'];
        $this->price = $row['price'];
      }
  }
}

  function readPrices(){
    parent::__construct();
    $rooms = array();
    $sql = "SELECT * FROM room_prices";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      while($row = $this->db->fetchRow()){
        $rooms[$row['room_type']] = $row['price'];
      }
      return $rooms;
    }
    else {
      return null;
    }
  }

  function insertPrice($room_type, $price){
    $sql = "INSERT INTO room_prices (room_type, price) VALUES ('$room_type' ,$price)";
    echo "$sql";
    $this->db->query($sql);
  }

  function editPrice($room_type,$price){
    $sql = "UPDATE room_prices SET price = $price WHERE room_type = '$room_type'";
    $this->db->query($sql);
  }

  function deletePrice($room_type){
    $sql = "DELETE FROM room_prices WHERE room_type = '$room_type'";
    $this->db->query($sql);
  }
}


?>
