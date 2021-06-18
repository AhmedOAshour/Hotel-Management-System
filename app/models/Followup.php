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

  function readFollowups($type){
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

  function readFollowup($id, $type){
    $sql = "SELECT * FROM " . $type . "_followup WHERE ID = $id";
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

  function insert($date, $comment, $file, $type){
    $entryBy = $_SESSION['ID'];
    $sql = "INSERT INTO " . $type . "_followup (date,comment,photo,entry_by) VALUES ('$date','$comment','$file','$entryBy')";
		if($this->db->query($sql) === true){
			echo "Records inserted successfully.";
		}
		else{
			echo "ERROR: Could not able to execute $sql. " . $this->db->getConn()->error;
		}
  }

  function deleteFollowup($id, $type){
    $sql = "DELETE FROM $type" . "_followup WHERE ID = $id ";
    if($this->db->query($sql) === true){
      return true;
    } else{
      return false;
    }
  }

}

?>
