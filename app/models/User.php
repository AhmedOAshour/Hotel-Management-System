<?php
class User extends Model
{
  public $id, $first_name , $last_name, $username, $password, $position, $sQuestion, $sAnswer;

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
        $this->sQuestion = $row['security_question'];
        $this->sAnswer = $row['security_answer'];
      }

    }
  }

  function login($username, $password){
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $this->db->query($sql);
    $row = $this->db->fetchRow();
   if (password_verify($password, $row['password']))
   {
      $this->id = $row['ID'];
      $_SESSION['ID'] = $this->id;
      $_SESSION['username'] = $row['username'];
      $_SESSION['position'] = $row['position'];
      header('Location: rooms.php');
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
    $sql = "SELECT * FROM user WHERE ID = '$ID'";
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

  function insertUser($first_name, $last_name, $password, $position, $username, $sQuestion, $sAnswer){
    $password=password_hash($password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (username,first_name,last_name,password,position,security_question,security_answer) VALUES ('$username','$first_name','$last_name','$password','$position','$sQuestion','$sAnswer')";
    $this->db->query($sql);

  }


  function editUser($first_name, $last_name, $password, $position, $username, $id, $sQuestion, $sAnswer){
    $password=password_hash($password,PASSWORD_DEFAULT);
    $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', password = '$password', position = '$position', username = '$username', security_question = '$sQuestion', security_answer = '$sAnswer' WHERE ID = '$id'";
    $this->db->query($sql);
  }

  function deleteUser($id){
    $sql = "DELETE FROM user WHERE ID = $id ";
    $this->db->query($sql);

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
      $password=password_hash($password,PASSWORD_DEFAULT);
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
    $sql1 = "SELECT * FROM user WHERE username = '$username'";
    $result = $this->db->query($sql1);
    $row = $this->db->fetchRow();
    if (password_verify($oldPass, $row['password']))
    {
      if ($newPass == $cNewPass) {
        $newPass=password_hash($newPass,PASSWORD_DEFAULT);
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
