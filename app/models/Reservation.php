<?php
class Reservation extends Model{
    public $id;
    public $client_id;
    public $bill_ID;
    public $room_type;
    public $price;
    public $arrival;
    public $departure;
    public $comments;
    public $number_of_rooms;

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
            $this->number_of_rooms=$row['number_of_rooms'];
            $this->price=$row['price'];
            $this->arrival=$row['arrival'];
            $this->departure=$row['departure'];
            $this->comments=$row['comments'];
          }
        }
        }

public function readReservations($checkin){
    $sql = "SELECT * ,reservation.ID AS RID FROM reservation INNER JOIN client ON reservation.client_ID = client.ID";
    if ($checkin) {
      $date = date('Y-m-d');
      $ext = " WHERE reservation.arrival = '$date' AND check_in is NULL";
      $sql .= $ext;
    }
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      return $result;
    }
    else {
      return null;
    }


}

public function editReservation($id,$client_ID,$room_type,$number_of_rooms,$arrival,$departure,$comments){
  $sql2="DELETE from reservedrooms where RID=$id";
  $this->db->query($sql2);
  
    $sql = "UPDATE reservation SET client_ID = '$client_ID' ,number_of_rooms='$number_of_rooms',arrival = '$arrival',departure='$departure' , comments='$comments' WHERE ID = '$id'";
    $this->db->query($sql);
    for($i=0;$i<count($room_type);$i++){
      $price=0;
      $sql="insert into reservedrooms (RID,room_type,price) values('$id','$room_type[$i]','$price')";
      $result = $this->db->query($sql);


    }




}
function deleteReservation($id){
    $sql = "DELETE FROM reservation WHERE ID = $id ";
    $sql2="DELETE from reservedrooms where RID=$id";
    $this->db->query($sql2);
    $this->db->query($sql);
   
  }








    }









?>
