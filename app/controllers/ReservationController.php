<?php
class ReservationController extends Controller{
    public function edit() {
        $client_id=$_REQUEST['client_ID'];
    $room_type=$_REQUEST['room_type'];
    $room_floor=$_REQUEST['room_floor'];
   $guest_names=$_REQUEST['guest_names'];
    $guest_count=$_REQUEST['guest_count'];
    $arrival=$_REQUEST['arrival'];
    $departure=$_REQUEST['departure'];
    $comments=$_REQUEST['comments'];
    $id=$_REQUEST['id'];
    $this->model->editReservation($id,$client_id,$room_type,$room_floor,$guest_names,$guest_count,$arrival,$departure,$comments);

  }
  public function delete(){
    $id = $_REQUEST['id'];
		$this->model->deleteReservation($id);
	}
    
           


}