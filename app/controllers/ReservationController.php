<?php
class ReservationController extends Controller{
    public function edit() {
      $errors=array();
   $client_id=$_REQUEST['client_ID'];
   $room_type=$_REQUEST['room_type'];
    $number_of_rooms=$_REQUEST['quantity'];
    $arrival=$_REQUEST['arrival'];
    $departure=$_REQUEST['departure'];
    $comments=$_REQUEST['comments'];
    $id=$_REQUEST['id'];
      
  if($temp=validDate($departure)){
    $errors['departure']=$temp;
  }
  if($temp=validDate($arrival)){
    $errors['arrival']=$temp;
  }
  if($temp=validInt($number_of_rooms)){
    $errors['number_of_rooms']=$temp;
  }
  if(count($errors)==0){
    $this->model->editReservation($id,$client_id,$room_type,$number_of_rooms,$arrival,$departure,$comments);
    return false;
        }
        else{
         
          return $errors;
        }
   

  }
  public function delete(){
    $id = $_REQUEST['id'];
		$this->model->deleteReservation($id);
	}
    
           


}