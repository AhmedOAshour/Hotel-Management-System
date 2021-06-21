<?php
class UserController extends Controller{
 public function Validate($first_name, $last_name, $password, $position, $username, $sQuestion, $sAnswer)
 {
   $errors=array();
   if($temp=validName($first_name)){
    $errors['fname']=$temp;

            }
  if($temp=validName($last_name)){
    $errors['lname']=$temp;
               }
  if($temp=validPassword($password)){
$errors['password']=$temp;
  }
  if($temp=validPosition($position)){
    $errors['position']=$temp;
               }
  if($temp=notEmpty($username)){
       $errors['username']=$temp;
                           }
   if($temp=notEmpty($sQuestion)){
        $errors['squestion']=$temp;
                                 }
      if($temp=notEmpty($sAnswer)){
           $errors['sanswer']=$temp;
                                 }
        return $errors;


 }
  public function insert() {
		$first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $password = $_REQUEST['password'];
    $position = $_REQUEST['position'];
    $username = $_REQUEST['username'];
    $sQuestion = $_REQUEST['sQuestion'];
    $sAnswer= $_REQUEST['sAnswer'];

    $errors=$this->Validate($first_name, $last_name, $password, $position, $username, $sQuestion, $sAnswer);
    if(count($errors)==0){
      if($temp=$this->model->insertUser($first_name, $last_name, $password, $position, $username, $sQuestion, $sAnswer)){
          $errors['username1']=$temp;
          return $errors;
      }
      return false;
          }
          else{
            return $errors;
          }
	}

	public function edit() {
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $password = $_REQUEST['password'];
    $position = $_REQUEST['position'];
    $username = $_REQUEST['username'];
    $sQuestion = $_REQUEST['sQuestion'];
    $sAnswer = $_REQUEST['sAnswer'];
    $id = $_REQUEST['id'];
    $errors=$this->Validate($first_name, $last_name, $password, $position, $username, $sQuestion, $sAnswer);
    if(count($errors)==0){
      $this->model->editUser($first_name, $last_name, $password, $position, $username, $id, $sQuestion, $sAnswer);
      return false;
          }
          else{

            return $errors;
          }


	}

  public function login() {
    $errors=array();
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

     $this->model->login($username, $password);



	}

	public function delete(){
    $id = $_REQUEST['id'];
		$this->model->deleteUser($id);
	}
}
?>
