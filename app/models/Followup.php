<?php
class Followup extends Model
{
  public $id, $date, $comment, $photo, $entryBy;

  function __construct($id="", $type=""){
    parent::__construct();
    if ($id!="" && $type!="") {
      $sql = "SELECT * FROM " . $type . "_followup WHERE ID = $id";
      $result = $this->db->query($sql);
      if ($result->num_rows == 1){
        $row = $this->db->fetchRow();
        $this->id = $row['ID'];
        $this->date = $row['date'];
        $this->reading = $row['reading'];
        $this->photo = $row['photo'];
        $this->entryBy = $row['entry_by'];
      }
    }
  }

  public function readFollowups($type){
    $followups = array();
    $sql = "SELECT ID FROM " . $type . "_followup";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      while($row = $this->db->fetchRow()){
        array_push($followups,new Followup($row['ID'], $type));
      }
      return $followups;
    }
    else {
      return null;
    }
  }

  public function readFollowup($id, $type){
    $followup = array();
    $sql = "SELECT * FROM " . $type . "_followup WHERE ID = $id";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      while($row = $this->db->fetchRow()){
        array_push($followup, $row['ID'], $row['date'], $row['reading'], $row['photo'], $row['entry_by']);
      }
      return $followup;
    }
    else {
      return null;
    }
  }

  public function insert($date, $comment, $file, $type){
    $entryBy = $_SESSION['ID'];
    $sql = "INSERT INTO " . $type . "_followup (date,comment,photo,entry_by) VALUES ('$date','$comment','$file','$entryBy')";
    $this->db->query($sql);
  }

  public function deleteFollowup($id, $type){
    $sql = "DELETE FROM $type" . "_followup WHERE ID = $id ";
    $this->db->query($sql);
  }

}

?>
