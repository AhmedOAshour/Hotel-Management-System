<?php
class LostAndFoundController extends Controller{
    function insert(){
    $room_number=$_REQUEST['room_number'];
    $item_description=$_REQUEST['item_description'];
    $HK_Username=$_REQUEST['username'];
    $date=$_REQUEST['date'];
$this->model->insert($room_number,$item_description,$HK_Username,$date);
    }
}
    ?>