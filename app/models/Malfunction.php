<?php
class Malfunction extends Model{
public $id,$description,$entry_by,$is_Archived,$date;
function __construct($id=""){
    parent::__construct();
    if ($id!="") {
      $sql = "SELECT * FROM malfunction WHERE ID = $id";
      $result = $this->db->query($sql);
      if ($result->num_rows == 1){
        $row = $this->db->fetchRow();
        $this->id = $row['ID'];
        $this->description = $row['description'];
        $this->entry_by = $row['entry_by'];
        $this->is_Archived = $row['is_Archived'];
        $this->date= $row['date'];
        
      }

    }
  }
  function insert($description,$entry_by,$date){
    $is_Archived="Pending";
    $sql = "INSERT INTO malfunction (description,entry_by,is_Archived,date) VALUES ('$description','$entry_by','$is_Archived','$date')";
    $this->db->query($sql);

  }
  function readMalfunctions(){
    $malfunctions = array();
    $sql = "SELECT ID FROM malfunction";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      while($row = $this->db->fetchRow()){
        array_push($malfunctions,new Malfunction($row['ID']));
      }
      return $malfunctions;
    }
    else {
      return null;
    }
  }




}

?>