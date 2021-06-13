<?php 
class Room extends Model{
public $number,$type,$floor,$status,$comments;

function __construct(){
    parent::__construct();
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
}