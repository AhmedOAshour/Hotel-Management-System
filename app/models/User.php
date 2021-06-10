<?php
// require_once

class User extends Model
{
  public $id, $first_name , $last_name, $username, $password, $position;

  function __construct($id=""){
    $this->db = $this->connect();
    if ($id!="") {
      $this->readUser($id);
    }
  }

  function login($username, $password){
    $sql = "SELECT ID FROM user WHERE username = $username AND password = $password";
    $result = $this->db->query($sql);
    if ($result->num_rows == 1){
			$row = $this->db->fetchRow();
      $this->id = $row['ID'];
      $_SESSION['ID'] = $this->id;
      $this->readUser($this->id);
      $_SESSION['username'] = $this->username;
      $_SESSION['position'] = $this->position;
		}
		else {
		}
  }

  function readUser($id){
    $sql = "SELECT * FROM user WHERE id = $id";
    $result = $this->db->query($sql);
    if ($result->num_rows == 1){
			$row = $this->db->fetchRow();
      $this->id = $row['id'];
      $this->first_name = $row['first_name'];
      $this->last_name = $row['last_name'];
      $this->username = $row['username'];
      $this->password = $row['password'];
      $this->position = $row['position'];
		}
		else {
      $this->id = "";
      $this->first_name = "";
      $this->last_name = "";
      $this->username = "";
      $this->password = "";
      $this->position = "";
		}
  }

  function readUsers(){
    $users = array();
    $sql = "SELECT ID FROM user";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      while($row = $this->db->fetchRow()){
        array_push($users,new User($row['id']));
      }
      return $users;
    }
    else {
      return null;
    }
  }

  function insertUser($first_name, $last_name, $password, $position, $username){
    $sql = "INSERT INTO user (username,first_name,last_name,password,position) VALUES ('$username','$first_name','$last_name','$password','$position')";
		if($this->db->query($sql) === true){
			echo "Records inserted successfully.";
		}
		else{
			echo "ERROR: Could not able to execute $sql. " . $conn->error;
		}
  }

  function editUser($first_name, $last_name, $password, $position, $username, $id){
    $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', password = '$password', position = '$position', username = '$username' WHERE ID = '$id'";
    if($this->db->query($sql) === true){
			echo "updated successfully.";
			$this->readUser($this->id);
		} else{
			echo "ERROR: Could not able to execute $sql. " . $conn->error;
		}
  }

  function deleteUser($id){
    $sql = "DELETE FROM user WHERE ID = $id ";
    if($this->db->query($sql) === true){
      echo "deleted successfully.";
    } else{
      echo "ERROR: Could not able to execute $sql. " . $conn->error;
    }
  }
}

?>
