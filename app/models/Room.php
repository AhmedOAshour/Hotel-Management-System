<?php
class Room extends Model{
public $number,$type,$status,$comments;

function __construct($number="")
{
  parent::__construct();
  if ($number!="") {
    $sql = "SELECT * FROM room WHERE number = '$number'";
    $result = $this->db->query($sql);
    if ($result->num_rows == 1){
      $row = $this->db->fetchRow();
      $this->number = $row['number'];
      $this->type = $row['type'];
      $this->status = $row['status'];
      $this->comments = $row['comments'];
    }
  }
}

function readRooms($type=""){
  $rooms = array();
  $sql;
  if ($type == "")
    $sql = "SELECT number FROM room";
  else
    $sql = "SELECT number FROM room WHERE type = '$type'";
  $result = $this->db->query($sql);
  if ($result->num_rows > 0){
    while($row = $this->db->fetchRow()){
      array_push($rooms,new Room($row['number']));
    }
    return $rooms;
  }
  else {
    return null;
  }
}

function insertRoom($number, $type, $status, $comments){
  $sql = "INSERT INTO room (number, type, status, comments) VALUES ('$number', '$type', '$status', '$comments')";
  $this->db->query($sql);

}

function editRoom($number, $type, $status, $comments){
  $sql = "UPDATE room SET type = '$type', status = '$status', comments = '$comments' where number = '$number'";
  $this->db->query($sql);

}

function deleteRoom($number){
  $sql = "DELETE FROM room WHERE number = '$number' ";
  $this->db->query($sql);
}
public function getRoomTypes(){
  $roomtypes=array();
  $sql = "SELECT DISTINCT type FROM room";
  $result = $this->db->query($sql);
  while($row = $this->db->fetchRow()){
      array_push($roomtypes,$row['type']);
  }
  return $roomtypes;
}
public function getReservation(){
  $sql = "SELECT ci.*, r.*, c.* FROM checked_in as ci
   INNER JOIN reservation as r
   ON r.ID = ci.reservation_ID
   INNER JOIN client as c
   ON c.ID = r.client_ID
   WHERE ci.room_no = '$this->number'";
  $result = $this->db->query($sql);
  $row = $this->db->fetchRow();
  return $row;
}
public function changeStatus($number,$status){
  $sql = "UPDATE room SET status = '$status' where number = '$number'";
  $this->db->query($sql);

}
public function checkout($number){
  $date = date('Y-m-d H:i:sP');
  $sql = "UPDATE reservation as r
          INNER JOIN checked_in as ci
          INNER JOIN room
          ON room.number = ci.room_no
          on r.ID = ci.reservation_ID
          SET r.check_out = '$date',room.status='available' WHERE room.number = '$number'";
  $sql1 = "DELETE FROM checked_in WHERE room_no = '$number'";
  $this->db->query($sql);
  $this->db->query($sql1);
}
public function getFreeType($type){
  $rooms = array();
  $sql = "SELECT number FROM room WHERE type = '$type' AND status = 'available'";
  $result = $this->db->query($sql);
  if ($result->num_rows > 0){
    while($row = $this->db->fetchRow()){
      array_push($rooms,new Room($row['number']));
    }
    return $rooms;
  }
  else {
    return null;
  }
}
public function getResTypes($id){
  $resTypes = array();
  $sql = "SELECT * FROM reservedrooms WHERE RID = '$id'";
  $result = $this->db->query($sql);
  if ($result->num_rows > 0){
    while($row = $this->db->fetchRow()){
      array_push($resTypes,$row['room_type']);
    }
    return $resTypes;
  }
  else {
    return null;
  }
}
public function checkin($room_numbers, $id){
  $date = date('Y-m-d H:i:sP');
  $sql = "INSERT INTO checked_in (reservation_ID,room_no) VALUES ";
  $sql2 = "UPDATE reservation SET check_in = '$date'  WHERE ID = $id";
  $sql1 = "UPDATE room SET status = 'booked'  WHERE number IN (";
  foreach ($room_numbers as $number) {
    $sql .= "($id,$number),";
    $sql1 .= "$number,";
  }
  $sql = rtrim($sql,',');
  $sql1 = rtrim($sql1,',');
  $sql1 .= ")";
  $this->db->query($sql);
  $this->db->query($sql1);
  $this->db->query($sql2);
}
}
?>
