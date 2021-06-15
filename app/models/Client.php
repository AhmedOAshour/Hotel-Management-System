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
      function createReservation($client_id,$room_type,$guest_names,$guest_count,$number_of_rooms,$price,$arrival,$departure,$comments){
       $sql="INSERT into reservation(client_id,guest_names,guest_count,number_of_rooms,price,arrival,departure,comments) values('$client_id','$guest_names','$guest_count','$number_of_rooms',$price,'$arrival','$departure','$comments')";
        $result = $this->db->query($sql);
        $newest_id = mysqli_insert_id($this->db->getConn());
        $price=0;
        for($i=0;$i<count($room_type);$i++){
          $sql="insert into reservedrooms (RID,room_type,price) values('$newest_id','$room_type[$i]','$price')";
          $result = $this->db->query($sql);
          

        }
    
      }
      function editClient($id,$first_name,$last_name,$identification_no ,$nationality, $mobile, $email, $company){
        $sql = "UPDATE client SET first_name = '$first_name', last_name = '$last_name', identification_no = '$identification_no', nationality = '$nationality', mobile = '$mobile',email='$email',company='$company' WHERE ID = '$id'";
        if($this->db->query($sql) === true){
          echo "updated successfully.";
        
      } else{
          echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }
      }
      function deleteClient($id){
        $sql = "DELETE FROM client WHERE ID = $id ";
        if($this->db->query($sql) === true){
          echo "deleted successfully.";
        } else{
          echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }
      }
    


}
