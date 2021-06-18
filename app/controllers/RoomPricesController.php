<?php

class RoomPricesController extends Controller
{
  public function insert() {
    $room_type = $_REQUEST['room_type'];
    $price = $_REQUEST['price'];

    $this->model->insertPrice($room_type, $price);
  }

  public function edit() {
    $room_type = $_REQUEST['room_type'];
    $price = $_REQUEST['price'];

    $this->model->editPrice($room_type,$price);
  }
}

?>
