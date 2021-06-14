<?php 
class Room extends Model{
public $number,$type,$floor,$status,$comments;

function __construct($number=""){
    parent::__construct();
    if ($number!="") {
        $sql="select * from room where number=$number";
        $result = $this->db->query($sql);
        $row = $this->db->fetchRow();
        $this-> number=$row['number'];
        $this->type=$row['type'];
        $this->floor=$row['floor'];
        $this->status=$row['status'];
        $this->comments=$row['comments'];
      
      }
}
public function getRoomType(){
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
public function readRooms(){
    
        $rooms = array();
        $sql = "SELECT number FROM room";
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


}
