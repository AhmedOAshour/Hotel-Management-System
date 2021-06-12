<?php
class ClientController extends Controller{
  public function insert() {
		$first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $nationality=$_REQUEST['nationality'];      
        $mobile=$_REQUEST['mobile'];
        $email=$_REQUESTR['email'];
        $company=$_REQUEST['company'];
        $identification_no=$_REQUEST['identification_no'];

		$this->model->addClient($first_name, $last_name, $identification_no, $nationality,$mobile,$mobile,$email,$company);
      
	}

	
}
?>
