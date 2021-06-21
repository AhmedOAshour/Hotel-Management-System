<?php
class LostAndFoundController extends Controller{
    function insert(){
        $errors=array();
    $room_number=$_REQUEST['room_number'];
    $item_description=$_REQUEST['item_description'];
    $HK_Username=$_REQUEST['username'];
    $date=$_REQUEST['date'];
    if($temp=notEmpty($item_description)){
        $errors['item_description']=$temp;
      }
      if($temp=validDate($date)){
        $errors['date']=$temp;
      }
      if($temp=validRoomNo($room_number)){
        $errors['room_number']=$temp;
      }
      if(count($errors)==0){
        $this->model->insert($room_number,$item_description,$HK_Username,$date);
        
        return false;
            }
            else{
             
              return $errors;
            }

    }
}
    ?>