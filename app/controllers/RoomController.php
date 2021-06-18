<?php
class RoomController extends Controller{
  public function insert(){
    $number = $_REQUEST['number'];
    $type = $_REQUEST['type'];
    $status = $_REQUEST['status'];
    $comments = $_REQUEST['comments'];

    $this->model->insertRoom($number, $type, $status, $comments);
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
