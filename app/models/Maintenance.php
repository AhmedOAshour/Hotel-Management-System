<?php
class Maintenance extends Model{
public $id,$malfunction_no,$date,$materials_bought,$cost_of_materials,$technician_name,$work_done;
function __construct($id=""){
    parent::__construct();
    if ($id!="") {
      $sql = "SELECT * FROM maintenance WHERE ID = $id";
      $result = $this->db->query($sql);
      if ($result->num_rows == 1){
        $row = $this->db->fetchRow();
        $this->id = $row['ID'];
        $this->malfunction_no = $row['malfunction_no'];
        $this->date=$row['date'];
        $this->materials_bought = $row['materials_bought'];
        $this->cost_of_materials = $row['cost_of_materials'];
        $this->technician_name= $row['technician_name'];
        $this->work_done=$row['work_done'];
      }
    }
  }

function readLogs(){
    $sql = "SELECT *,maintenance.date AS MDate FROM maintenance INNER JOIN malfunction ON maintenance.malfunction_no=malfunction.ID";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      return $result;
    }
    else {
      return null;
    }
}
function insert($malfunction_no,$date,$materials_bought,$cost_of_materials,$technician_name,$work_done){
    $is_Archived="Archived";
    $sql = "INSERT INTO maintenance (malfunction_no,date,materials_bought,cost_of_materials,technician_name,work_done) VALUES ('$malfunction_no','$date','$materials_bought','$cost_of_materials','$technician_name','$work_done')";
    $sql2="UPDATE malfunction SET is_Archived = '$is_Archived' WHERE ID = '$malfunction_no'";
    $this->db->query($sql);
    $this->db->query($sql2);
	


}
}



?>