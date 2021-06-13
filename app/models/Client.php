<?php
class client extends Model{
    public $id,$first_name,$last_name,$identification_no ,$nationality, $mobile, $email, $company;
    function __construct($id=""){
      parent::__construct();
      if ($id!="") {
        $sql="select * from client where ID=$id";
        $result = $this->db->query($sql);
        $row = $this->db->fetchRow();
        $this-> id=$row['ID'];
        $this->first_name=$row['first_name'];
        $this->last_name=$row['last_name'];
        $this->identification_no=$row['identification_no'];
        $this->nationality=$row['nationality'];
        $this->mobile=$row['mobile'];
        $this->email=$row['email'];
        $this->company=$row['company'];
      }
    }
  
  
      function addClient($first_name,$last_name,$identification_no,$nationality,$mobile,$email,$company){
        $sql = "INSERT INTO client(first_name, last_name, identification_no, nationality, mobile, email, company) VALUES ('$first_name','$last_name','$identification_no','$nationality','$mobile','$email','$company')";
        $result = $this->db->query($sql);
        
      }
      function readClients(){
        $clients = array();
        $sql = "SELECT ID FROM client";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0){
          while($row = $this->db->fetchRow()){
            array_push($clients,new client($row['ID']));
            
          }
          return $clients;
        }
        else {
          return null;
        }
      }
      function createReservation($client_id,$room_type,$room_floor,$guest_names,$guest_count,$price,$arrival,$departure,$comments){
        $sql="INSERT into reservation(client_id,room_type,room_floor,guest_names,guest_count,price,arrival,departure,comments) values('$client_id','$room_type','$room_floor','".$guest_names."','$guest_count',$price,'".$arrival."','".$departure."','".$comments."')";
        $result = $this->db->query($sql);
     
      }
    


}
