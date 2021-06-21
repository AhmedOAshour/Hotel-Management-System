<?php
class followupController extends Controller{

  public function Validate($date, $file, $type){
    $errors=array();
    if($temp=validImage($file)){
     $errors['file']=$temp;
   }
    if($temp=validDate($date)){
     $errors['date']=$temp;
   }
    if($temp=validType($type)){
     $errors['type']=$temp;
   }
    return $errors;
}

  public function insert(){
		$date = $_REQUEST['date'];
    $comment = $_REQUEST['comment'];
    $file = $_FILES['myfile']['name'];
    $type = $_REQUEST['type'];

    $errors=$this->Validate($date, $file, $type);
    if(count($errors)==0){
      $this->model->insert($date, $comment, $file, $type);
      return false;
    }
    else {
      return $errors;
    }
}

	public function delete(){
    $id = $_REQUEST['id'];
    $type = $_REQUEST['type'];
		$this->model->deleteFollowup($id, $type);
	}
}
?>
