<?php
class ClientController extends Controller{
  public function insert() {
		$first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $nationality=$_REQUEST['nationality'];      
        $mobile=$_REQUEST['mobile'];
        $email=$_REQUEST['email'];
        $company=$_REQUEST['company'];
        $identification_no=$_REQUEST['identification_no'];

		$this->model->addClient($first_name, $last_name, $identification_no, $nationality,$mobile,$email,$company);
      
	}
  public function createReservation(){
    $client_id=$_REQUEST['client_ID'];
    $room_type=$_REQUEST['room_type'];
    $number_of_rooms=$_REQUEST['quantity'];
    $price=0;
    $arrival=$_REQUEST['arrival'];
    $departure=$_REQUEST['departure'];
    $comments=$_REQUEST['comments'];
    $this->model->createReservation($client_id,$room_type,$number_of_rooms,$price,$arrival,$departure,$comments);

  }
  public function edit(){
    $id=$_REQUEST['id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $nationality=$_REQUEST['nationality'];      
    $mobile=$_REQUEST['mobile'];
    $email=$_REQUEST['email'];
    $company=$_REQUEST['company'];
    $identification_no=$_REQUEST['identification_no'];



    $this->model->editClient($id,$first_name,$last_name,$identification_no ,$nationality, $mobile, $email, $company);
  }
  public function delete(){
    $id = $_REQUEST['id'];
		$this->model->deleteClient($id);
	}

	
}
?>
