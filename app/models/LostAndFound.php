<?php
class LostAndFound extends Model{
public $id,$room_number,$item_description,$HK_Username,$date;
function __construct($id=""){
    parent::__construct();
    if ($id!="") {
        $sql="select * from lost_and_found where ID=$id";
        $result = $this->db->query($sql);
        $row = $this->db->fetchRow();
        $this-> id=$row['ID'];
        $this->room_number=$row['room_number'];
        $this->item_description=$row['item_description'];
        $this->HK_Username=$row['HK_Username'];
        $this->date=$row['date'];
        
      }
}
public function insert($room_number,$item_description,$HK_Username,$date){
$sql="INSERT INTO lost_and_found (room_number,item_description,HK_Username,date) values ('$room_number','$item_description','$HK_Username','$date')";
$result = $this->db->query($sql);


}
function readEntries(){
    $entries = array();
    $sql = "SELECT ID FROM lost_and_found";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      while($row = $this->db->fetchRow()){
        array_push($entries,new LostAndFound($row['ID']));
        
      }
      return $entries;
    }
    else {
      return null;
    }
  }




}