<?php
class ReservationController extends Controller{
    public function edit() {
   $client_id=$_REQUEST['client_ID'];
   $room_type=$_REQUEST['room_type'];
   $guest_names=$_REQUEST['guest_names'];
   $guest_count=$_REQUEST['guest_count'];
    $number_of_rooms=$_REQUEST['quantity'];
    $arrival=$_REQUEST['arrival'];
    $departure=$_REQUEST['departure'];
    $comments=$_REQUEST['comments'];
    $id=$_REQUEST['id'];
    $this->model->editReservation($id,$client_id,$room_type,$guest_names,$number_of_rooms,$guest_count,$arrival,$departure,$comments);

  }
  public function delete(){
    $id = $_REQUEST['id'];
		$this->model->deleteReservation($id);
	}
    
           


}