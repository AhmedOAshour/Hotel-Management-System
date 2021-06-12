<?php
class client extends Model{
    public $id,$first_name,$last_name,$identification_no $nationality, $mobile, $email, $company;
    function __construct($id=""){
  
      if ($id!="") {
        $this->readClient($id);
      }
    }
  
 
      function readClient($id){
        $SQL="select * from client where ID=$id";
        $result = $this->db->query($sql);
        $row = $this->db->fetchRow();
        $this-> id=$row[0];
        $this->first_name=$row[1];
        $this->last_name=$row[2];
        $this->identification_no=$row[3];
        $this->nationality=$row[4];
        $this->mobile=$row[5];
        $this->email=$row[6];
        $this->company=$row[7];
       
      }
      function addClient(){
        $sql = "INSERT INTO client(first_name, last_name, identification_no, nationality, mobile, email, company) VALUES ('$first_name','$last_name','$identification_no','$nationality','$mobile','$email','$company')";
        $result = $this->db->query($sql);
      }
      function readClients(){
        $clients = array();
        $sql = "SELECT ID FROM client";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0){
          while($row = $this->db->fetchRow()){
            array_push($clients,new client($row['id']));
            
          }
          return $clients;
        }
        else {
          return null;
        }
      }
    


}
