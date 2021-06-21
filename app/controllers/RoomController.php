<?php
class RoomController extends Controller{
  public function validate($number, $type, $status){
    $errors = array();
    if ($temps = validRoomNo($number)) {
      $errors['number']=$temp;
    }
    if ($temps = validRoomType($type)) {
      $errors['type']=$temp;
    }
    if ($temps = validRoomStatuso($status)) {
      $errors['status']=$temp;
    }
  }

  public function insert(){
    $number = $_REQUEST['number'];
    $type = $_REQUEST['type'];
    $status = $_REQUEST['status'];
    $comments = $_REQUEST['comments'];

    $errors=$this->Validate($number, $type, $status);
    if(count($errors)==0){
      if($temp=$this->model->insertRoom($number, $type, $status, $comments)){
          $errors['number']=$temp;
          return $errors;
      }
      return false;
          }
          else{
            return $errors;
          }
  }

  public function edit(){
    $number = $_REQUEST['number'];
    $type = $_REQUEST['type'];
    $status = $_REQUEST['status'];
    $comments = $_REQUEST['comments'];

    $this->model->editRoom($number, $type, $status, $comments);
  }

  public function delete(){
    $number = $_REQUEST['number'];
    $this->model->deleteRoom($number);
  }
}
?>
