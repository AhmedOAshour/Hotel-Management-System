<?php
class User extends Model
{
  public $id, $first_name , $last_name, $username, $password, $position;

  function __construct($id=""){
    parent::__construct();
    if ($id!="") {
      $sql = "SELECT * FROM user WHERE ID = $id";
      $result = $this->db->query($sql);
      if ($result->num_rows == 1){
        $row = $this->db->fetchRow();
        $this->id = $row['ID'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->position = $row['position'];
      }

    }
  }

  function login($username, $password){
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $this->db->query($sql);
    if ($result->num_rows == 1){
			$row = $this->db->fetchRow();
      $this->id = $row['ID'];
      $_SESSION['ID'] = $this->id;
      $_SESSION['username'] = $row['username'];
      $_SESSION['position'] = $row['position'];
      header('Location: profile.php');
		}
		else {
      echo "Wrong Credentials.";
		}
  }

  function readUsers(){
    $users = array();
    $sql = "SELECT ID FROM user";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      while($row = $this->db->fetchRow()){
        array_push($users,new User($row['ID']));
      }
      return $users;
    }
    else {
      return null;
    }
  }

  function readProfile(){
    $info = array();
    $ID = $_SESSION['ID'];
    $sql = "SELECT * FROM user WHERE ID = $ID";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      $row = $this->db->fetchRow();
      array_push($info, $row['ID']);
      array_push($info, $row['first_name']);
      array_push($info, $row['last_name']);
      array_push($info, $row['username']);
      array_push($info, $row['position']);
      return $info;
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
			echo "ERROR: Could not able to execute $sql. " . $this->db->getConn()->error;
		}
  }

  function editUser($first_name, $last_name, $password, $position, $username, $id){
    $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', password = '$password', position = '$position', username = '$username' WHERE ID = '$id'";
    if($this->db->query($sql) === true){
			echo "updated successfully.";

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

  function getQuestion($username){
    $sql = "SELECT security_question FROM user WHERE username = '$username'";
    $result = $this->db->query($sql);
    $row = $this->db->fetchRow();
    return $row['security_question'];
  }

  function validateAnswer($answer, $username){
    $sql = "SELECT * FROM user WHERE username = '$username' AND security_answer = '$answer'";
    $result = $this->db->query($sql);
    if ($result->num_rows == 1){
      return true;
    }
    return false;
  }

  function newPassword($username, $password, $cPassword){
    if ($password == $cPassword) {
      $sql = "UPDATE user SET password = '$password' WHERE username = '$username'";
      if ($this->db->query($sql) === true) {
        return true;
      }
    }
    else {
      return false;
    }
  }

  function changePass($oldPass, $newPass, $cNewPass){
    $username = $_SESSION['username'];
    $sql1 = "SELECT * FROM user WHERE password = '$oldPass'";
    $result = $this->db->query($sql1);
    if ($result->num_rows == 1){
      if ($newPass == $cNewPass) {
        $sql2 = "UPDATE user SET password = '$newPass' WHERE username = '$username'";
        if ($this->db->query($sql2) === true) {
          return true;
        }
      }
      else {
        return false;
      }
    }

  }
}

?>
