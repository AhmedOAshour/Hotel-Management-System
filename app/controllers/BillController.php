<?php
class BillController extends Controller{
public function insertItem(){
    $id=$_REQUEST['id'];
    $item=$_REQUEST['item'];
    $price=$_REQUEST['price'];
    $this->model->addItem($id,$item,$price);
}
public function delete(){
$id=$_REQUEST['itemid'];
$this->model->deleteItem($id);

}

}
    ?>