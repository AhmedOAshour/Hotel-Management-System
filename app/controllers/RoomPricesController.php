<?php

class RoomPricesController extends Controller
{
  public function insert() {
  $errors=array();
    $room_type = $_REQUEST['room_type'];
    $price = $_REQUEST['price'];
    if($temp=validRoomType($room_type)){
      $errors['room_type']=$temp;
    }
    if($temp=validNumeric($price)){
      $errors['price']=$temp;
    }
    if(count($errors)==0){
      $this->model->insertPrice($room_type, $price);
  
  return false;
      }
      else{
       
        return $errors;
      }


    
  }

  public function edit() {
    $errors=array();
    $room_type = $_REQUEST['room_type'];
    $price = $_REQUEST['price'];
    if($temp=validRoomType($room_type)){
      $errors['room_type']=$temp;
    }
    if($temp=validNumeric($price)){
      $errors['price']=$temp;
    }
    if(count($errors)==0){
      $this->model->editPrice($room_type,$price);
      return false;
    }

      
      else{
       
        return $errors;
      }
    }

    
}

?>
