<?php
class ClientController extends Controller{
 public function Validate($first_name,$last_name,$identification_no,$nationality,$mobile,$email,$company){

  $errors=array();

  if($temp=validEmail($email)){
    $errors['email']=$temp;
  }
  if($temp=validName($first_name)){
    $errors['fname']=$temp;
    
            }
  if($temp=validName($last_name)){
    $errors['lname']=$temp;
               }
  if($temp=notEmpty($company)){
   $errors['company']=$temp;
                           }
   if($temp=validName($nationality)){
    $errors['nationality']=$temp;
    }
    if($temp=validMobileNo($mobile)){
      $errors['mobile']=$temp;
                              }
      if($temp=notEmpty($identification_no)){
         $errors['idn']=$temp;
              }
              return $errors;

                      
 } 
  
  public function insert() {
        
       $values=array();
	    	$first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $nationality=$_REQUEST['nationality'];      
        $mobile=$_REQUEST['mobile'];
        $email=$_REQUEST['email'];
        $company=$_REQUEST['company'];
        $identification_no=$_REQUEST['identification_no'];
       $errors=$this->Validate($first_name,$last_name,$identification_no,$nationality,$mobile,$email,$company);                                                               
       
        if(count($errors)==0){
		$this->model->addClient($first_name, $last_name, $identification_no, $nationality,$mobile,$email,$company);
    
    return false;
        }
        else{
         
          return $errors;
        }
      
	}
  public function createReservation(){
    $errors=array();
    $client_id=$_REQUEST['client_ID'];
    $room_type=$_REQUEST['room_type'];
    $number_of_rooms=$_REQUEST['quantity'];
    $price=0;
    $arrival=$_REQUEST['arrival'];
    $departure=$_REQUEST['departure'];
    $comments=$_REQUEST['comments'];
    

  
  if($temp=validDate($departure)){
    $errors['departure']=$temp;
  }
  if($temp=validDate($arrival)){
    $errors['arrival']=$temp;
  }
  if($temp=validInt($number_of_rooms)){
    $errors['number_of_rooms']=$temp;
  }
  if(count($errors)==0){
    $this->model->createReservation($client_id,$room_type,$number_of_rooms,$price,$arrival,$departure,$comments);
    
    return false;
        }
        else{
         
          return $errors;
        }
   

  }

  public function edit(){
    $id=$_REQUEST['id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $nationality=$_REQUEST['nationality'];      
    $mobile=$_REQUEST['mobile'];
    $email=$_REQUEST['email'];
    $company=$_REQUEST['company'];
    $identification_no=$_REQUEST['identification_no'];
    $errors=$this->Validate($first_name,$last_name,$identification_no,$nationality,$mobile,$email,$company);
     
    if(count($errors)==0){
      $this->model->editClient($id,$first_name,$last_name,$identification_no ,$nationality, $mobile, $email, $company);
      return false;
          }
          else{
           
            return $errors;
          }   



  
  }
  public function delete()
  {
    $id = $_REQUEST['id'];
		$this->model->deleteClient($id);
	}

	
}
?>
