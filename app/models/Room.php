<?php
class Room extends Model{
public $number,$type,$floor,$status,$comments;

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
      $this->floor = $row['floor'];
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

function insertRoom($number, $type, $floor, $status, $comments){
  $sql = "INSERT INTO room (number, type, floor, status, comments) VALUES ('$number', '$type', '$floor', '$status', '$comments')";
  if($this->db->query($sql) === true){
    echo "Records inserted successfully.";
  }
  else{
    echo "ERROR: Could not able to execute $sql. " . $this->db->getConn()->error;
  }
}

function editRoom($number, $type, $floor, $status, $comments){
  $sql = "UPDATE room SET type = '$type', floor = '$floor', status = '$status', comments = '$comments' where number = '$number'";
  if($this->db->query($sql) === true){
    echo "Records inserted successfully.";
  }
  else{
    echo "ERROR: Could not able to execute $sql. " . $this->db->getConn()->error;
  }
}

function deleteRoom($number){
  $sql = "DELETE FROM room WHERE number = '$number' ";
  if($this->db->query($sql) === true){
    echo "deleted successfully.";
  } else{
    echo "ERROR: Could not able to execute $sql. " . $conn->error;
  }
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
public function getFloorsNo(){
  $floorno=array();
  $sql = "SELECT DISTINCT floor FROM room";
  $result = $this->db->query($sql);
  while($row = $this->db->fetchRow()){
      array_push($floorno,$row['floor']);
  }
  return $floorno;
}
public function getReservation(){
  $sql = "SELECT c.first_name,c.last_name,r.ID FROM checked_in as ci
   INNER JOIN reservation as r
   ON r.ID = ci.reservation_ID
   INNER JOIN client as c
   ON c.ID = r.client_ID
   WHERE ci.room_no = '$this->number'";
  $result = $this->db->query($sql);
  $row = $this->db->fetchRow();
  return $row;
}
}
