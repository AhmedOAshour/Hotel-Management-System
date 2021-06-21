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

      function readClients($bar=""){
        $clients = array();
        $sql = "SELECT ID FROM client";
        if ($bar!="") {
          $sql .= " WHERE first_name LIKE '%$bar%' OR last_name LIKE '%$bar%' OR nationality LIKE '%$bar%' OR identification_no LIKE '%$bar%' OR mobile LIKE '%$bar%' OR email LIKE '%$bar%' OR company LIKE '%$bar%'";
        }
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

      function createReservation($client_id,$room_type,$number_of_rooms,$price,$arrival,$departure,$comments){
        $sql="INSERT into reservation(client_id,number_of_rooms,price,arrival,departure,comments) values('$client_id','$number_of_rooms',$price,'$arrival','$departure','$comments')";
        $result = $this->db->query($sql);
        $reservation_id = mysqli_insert_id($this->db->getConn());

        $sql = "INSERT INTO bill(reservation_ID) VALUES ($reservation_id)";
        $result = $this->db->query($sql);
        $bill_id=mysqli_insert_id($this->db->getConn());
        $sql="UPDATE RESERVATION SET bill_ID='$bill_id' WHERE ID='$reservation_id' ";
        $result = $this->db->query($sql);
        $rooms = array();
        $sql = "SELECT * FROM room_prices";
        $result = $this->db->query($sql);
          while($row = $this->db->fetchRow()){
            $rooms[$row['room_type']] = $row['price'];
          }
        for($i=0;$i<count($room_type);$i++){
          $sql="INSERT INTO reservedrooms (RID,room_type) VALUES('$reservation_id','$room_type[$i]')";
          $price = $rooms[$room_type[$i]];
          $sql3 = "INSERT INTO bill_items(bill_ID,item,price,is_Room) VALUES('$bill_id', '$room_type[$i]', $price,'1')";
          $result = $this->db->query($sql);
          $result = $this->db->query($sql3);
        }
      }

      function editClient($id,$first_name,$last_name,$identification_no ,$nationality, $mobile, $email, $company){
        $sql = "UPDATE client SET first_name = '$first_name', last_name = '$last_name', identification_no = '$identification_no', nationality = '$nationality', mobile = '$mobile',email='$email',company='$company' WHERE ID = '$id'";
        $this->db->query($sql);
      }

      function deleteClient($id){
        $sql = "DELETE FROM client WHERE ID = $id ";
        $this->db->query($sql);
      }
}
