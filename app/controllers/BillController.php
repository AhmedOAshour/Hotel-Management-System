<?php
class BillController extends Controller{
public function insertItem(){
    $errors=array();
    $id=$_REQUEST['id'];
    $item=$_REQUEST['item'];
    $price=$_REQUEST['price'];
    if($temp=notEmpty($item)){
        $errors['item']=$temp;
      }
      if($temp=validId($price)){
        $errors['price']=$temp;
        
                }
                
        if(count($errors)==0){
            $this->model->addItem($id,$item,$price);
           return false;
}
        
        
            
            else{
             
              return $errors;
            }
          }
    
public function delete(){
$id=$_REQUEST['itemid'];
$this->model->deleteItem($id);

}

}
    ?>