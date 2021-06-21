<?php 
class MalfunctionController extends Controller{
public function insert(){
    $errors=array();
$description=$_REQUEST['description'];
$entry_by=$_REQUEST['username'];
$date=$_REQUEST['date'];
if($temp=validDate($date)){
    $errors['date']=$temp;
  }
  
  if($temp=notEmpty($description)){
    $errors['description']=$temp;
               }
               if(count($errors)==0){
                $this->model->insert($description,$entry_by,$date);
            
            return false;
                }
                else{
                 
                  return $errors;
                }

}



}