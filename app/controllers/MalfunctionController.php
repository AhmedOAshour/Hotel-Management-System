<?php 
class MalfunctionController extends Controller{
public function insert(){
$description=$_REQUEST['description'];
$entry_by=$_REQUEST['username'];
$date=$_REQUEST['date'];
$this->model->insert($description,$entry_by,$date);
}



}