<?php
class RoomController extends Controller{
  public function insert(){
    $number = $_REQUEST['number'];
    $type = $_REQUEST['type'];
    $floor = $_REQUEST['floor'];
    $status = $_REQUEST['status'];
    $comments = $_REQUEST['comments'];

    $this->model->insertRoom($number, $type, $floor, $status, $comments);
  }

  public function edit(){
    $number = $_REQUEST['number'];
    $type = $_REQUEST['type'];
    $floor = $_REQUEST['floor'];
    $status = $_REQUEST['status'];
    $comments = $_REQUEST['comments'];

    $this->$model->editRoom($number, $type, $floor, $status, $comments);
  }

  public function delete(){
    $number = $_REQUEST['number'];
    $this->$model->deleteRoom($number);
  }
}
?>
