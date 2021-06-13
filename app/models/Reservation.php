<?php
class Reservation extends Model{
    public $id;
    public $client_id;
    public $bill_ID;
    public $room_type;
    public $room_floor;
    public $guest_names;
    public $guest_count;
    public $price;
    public $arrival;
    public $departure;
    public $comments;
  
    function __construct($id=""){
        parent::__construct();
        if ($id!="") {
          $sql = "SELECT * FROM reservation WHERE ID = $id";
          $result = $this->db->query($sql);
          if ($result->num_rows == 1){
            $row = $this->db->fetchRow();
            $this->id = $row['ID'];
            $this->client_id= $row['client_ID'];
            $this->bill_ID = $row['bill_ID'];
            $this->room_type = $row['room_type'];
            $this->room_floor= $row['room_floor'];
            $this->guest_names = $row['guest_names'];
            $this->guest_count=$row['guest_count'];
            $this->price=$row['price'];
            $this->arrival=$row['arrival'];
            $this->departure=$row['departure'];
            $this->comments=$row['comments'];
          }
        }
        }
     
public function readReservations(){
   
    $sql = "SELECT * ,reservation.ID AS RID FROM reservation INNER JOIN client ON reservation.client_ID = client.ID";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      return $result;
    }
    else {
      return null;
    }


}

public function editReservation($id,$client_ID,$room_type,$room_floor,$guest_names,$guest_count,$arrival,$departure,$comments){
    $sql = "UPDATE reservation SET client_ID = '$client_ID', room_type = '$room_type', room_floor = '$room_floor', guest_names = '$guest_names', guest_count = '$guest_count' ,arrival = '$arrival',departure='$departure' , comments='$comments' WHERE ID = '$id'";
    if($this->db->query($sql) === true){
			echo "updated successfully.";
    
	} else{
			echo "ERROR: Could not able to execute $sql. " . $conn->error;
		}

    
}
function deleteReservation($id){
    $sql = "DELETE FROM reservation WHERE ID = $id ";
    if($this->db->query($sql) === true){
      echo "deleted successfully.";
    } else{
      echo "ERROR: Could not able to execute $sql. " . $conn->error;
    }
  }
  
    
    
    
    
    
    
    
    }





  
    
  
  
?>