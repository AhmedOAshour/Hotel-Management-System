<?php
class UserController extends Controller{

  public function insert() {
		$first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $password = $_REQUEST['password'];
    $position = $_REQUEST['position'];
    $username = $_REQUEST['username'];

		$this->model->insertUser($first_name, $last_name, $password, $position, $username);
	}

	public function edit() {
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $password = $_REQUEST['password'];
    $position = $_REQUEST['position'];
    $username = $_REQUEST['username'];
    $id = $_REQUEST['id'];

		$this->model->editUser($first_name, $last_name, $password, $position, $username,$id);
	}

  public function login() {
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
