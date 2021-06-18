<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
<style>
  .forgot{
    position: relative;
    left:270px;
    bottom:100px;
    color:#000026;
  }
  .forgot:hover{
    text-decoration:none;
    color:blue;
  }
</style>
  </body>
</html>
<?php
class ViewUser extends View{
  public function output(){
    $users = $this->model->readUsers();
    $str =
    <<<EOD
    <div class="container">
    <h1>Employees</h1>
    <div id="viewEmployees">
      <table>
        <thead>
          <tr>
            <th style='text-align:center'><strong>ID</strong></th>
            <th style='text-align:center'><strong>First Name</strong></th>
            <th style='text-align:center'><strong>Last Name</strong></th>
            <th style='text-align:center'><strong>Username</strong></th>
            <th style='text-align:center'><strong>Position</strong></th>
            <th style='text-align:center'><strong>Edit</strong></th>
            <th style='text-align:center'><strong>Delete</strong></th>
          </tr>
        </thead>
        <tbody>
    EOD;
        foreach ($users as $user) {
          $str .= <<<EOD
          <tr>
            <td style='text-align:center'>$user->id</td>
            <td style='text-align:center'>$user->first_name</td>
            <td style='text-align:center'>$user->last_name</td>
            <td style='text-align:center'>$user->username</td>
            <td style='text-align:center'>$user->position</td>
            <td style='text-align:center'><a class="color" href="employees.php?action=editform&id=$user->id"><i class='fa fa-edit'></a></td>
            <td style='text-align:center'><a class="color" href="employees.php?action=delete&id=$user->id"><i class='fa fa-trash'></i></a></td>
          </tr>
          EOD;
        }
    $str .= <<<EOD
        </tbody>
      </table>
      <br>
    </div>
    <a href="employees.php?action=addform"><button type="button" class="button2" id="addBtn">Add Employee</button></a>
    EOD;
    echo $str;
  }
  public function addForm(){
    $str=<<<EOD
    <div class="container">
    <h1>Add Employee</h1>
    <form class="addE" oninput="checkAddEdit()">
    <div id="addEmployees" class="addEmployees">
        <div id="errorName1">
        </div>
        <input type="text" name="first_name" id="Fname" class="formE form-control mb-4 border-0 py-4" placeholder="First Name" required><br>
        <div id="errorName2">
        </div>
        <input type="text" name="last_name" id="Lname" class="formE form-control mb-4 border-0 py-4" placeholder="Last Name" required><br>
        <div id="errorUsername">
        </div>
        <input type="text" name="username" id="username" class="formE form-control mb-4 border-0 py-4" placeholder="Username" required><br>
        <div id="errorPass">
        </div>
        <input type="password" name="password" id="password" class="formE form-control mb-4 border-0 py-4"placeholder="Password" required><br>
        <select id="position" name="position" class="formE form-control mb-2 border-0" required>
          <option hidden disabled selected value>Position</option>
          <option value='admin'>admin</option>
          <option value='front_clerk'>Front Clerk</option>
          <option value='reservation_clerk'>Reservation Clerk</option>
          <option value='HK_employee'>Housekeeping</option>
        </select><br>
        <input type="submit" class="submitEmployee button2" name="action" value="Add" id="submitBtn">
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function editForm($id){
    $user = new User($id);
      $str=<<<EOD
      <div class="container">
      <h1>Edit Employees</h1>
      <form class="editE" oninput="checkAddEdit()">
        <input type="text" name="id" value="$id" style="display:none">
        <label class='names' for='first_name'>First Name</label><input type='text' required name='first_name' id='Fname' class='form form-control mb-4 border-0 py-4 ' value='$user->first_name' '> <br><br>
        <div id="errorName1">
        </div>
        <label class='names' for='last_name'>Last Name</label><input type='text' required name='last_name' id='Lname' class='form form-control mb-4 border-0 py-4' value='$user->last_name' '> <br><br>
        <div id="errorName2">
        </div>
        <label class='names' for='username'>Username</label><input type='text' required name='username' id='username' class='form form-control mb-4 border-0 py-4' value='$user->username' '> <br><br>
        <div id="errorUsername">
        </div>
        <label class='names' for='password'>Password</label><input type='password' required name='password' id='password' class='form form-control mb-4 border-0 py-4' value='' '> <br><br>
        <div id="errorPass">
        </div>
        <h4 class='names'  for='position'>Position</h4>
        <select id='position' name='position' class='form form-control mb-4 border-0 py-2'>
        <option value='front_clerk'>Front Clerk</option>
        <option value='reservation_clerk'>Reservation Clerk</option>
        <option value='HK_employee'>HouseKeeping Clerk</option>
        </select> <br><br>
        <input type='submit'  name='action' value="edit" class='button2'>
      </form>
      EOD;
      echo $str;
  }
  public function loginForm(){
    $str=<<<EOD
    <div class="container">
    <div id="login">
    <h1>Login</h1>
    <form class="login">
        <input type="text" name="username" id="username" class="formE form-control mb-4 border-0 py-4" placeholder="Username" required><br>
        <input type="password" name="password" id="password" class="formE form-control mb-4 border-0 py-4"placeholder="Password" required><br>
        <input type="submit" class="login button2" name="action" value="login" id="submitBtn"><br>
        <a class="forgot" href="index.php?action=forgotpass">Forgot Password?</a>
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function forgotPass(){
    $str=<<<EOD
    <div class="container">
    <div id="login">
    <h1>Forget Password</h1>
    <form class="login">
        <input type="text" name="username" id="username" class="formE form-control mb-2 border-0 py-2" placeholder="Username" required><br>
        <button type='submit' name='action' class="button2"value='security'>Next</button>
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function security($username){
    $question = $this->model->getQuestion($username);
    $str=<<<EOD
    <div class="container">
    <div id="login">
    <form class="login">
        <h1>Security Question</h1>
        <input class='formE form-control mb-4 border-0 py-4' for='question' disabled value='$question ?'><br>
        <input type="text" name="answer" id="answer" placeholder="Answer.."class="formE form-control mb-4 border-0 py-4"><br>
        <input type="text" name="username" value="$username" style="display:none;" required>
        <input type="submit" class="button2" name="action" value="validate" id="submitBtn">
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function newPassword($username){
    $str=<<<EOD
    <div class="container">
    <div id="login">
    <form class="login">
        <input type="text" name="username" value="$username" style="display:none;" >
        <label class='password' for='password'>New Password</label><br><input type="text" name="password" class="formE form-control mb-4 border-0 py-4" required><br>
        <label class='confirmPassword' for='confirmPassword'>Confirm Password</label><br><input type="text" class="confirmP" name="cPassword" required><br>
        <button type="submit" name="action" value="newPass">Submit</button>
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function changePasswordForm(){
    $str=<<<EOD
    <div class="container">
    <h1>Change Password</h1>
    <div id="changePass">
    <form class="changePass" oninput="checkNewPass()">
        <input type="text" name="oldPass" placeholder="Old Password"class="formE form-control mb-4 border-0 py-4" required><br>
        <input type="text" name="newPass" id="newPass" placeholder="New Password"class="formE form-control mb-4 border-0 py-4" required><br>
        <div id="errorNewPass">
        </div>
        <input type="text" name="cNewPass" placeholder="Confirm New Password"id="cNewPass" class="formE form-control mb-4 border-0 py-4" required><br>
        <div id="errorCNewPass">
        </div>
        <button type="submit" name="action" class="button2"value="confirmPass">Submit</button>
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function profile($username){
    $info = $this->model->readprofile();
    $str =
    <<<EOD
    <div class="container">
    <h1>My Profile</h1>
    <div id="profile">
      <table>
        <thead>
          <tr>
            <th style='text-align:center'><strong>ID</strong></th>
            <th style='text-align:center'><strong>First Name</strong></th>
            <th style='text-align:center'><strong>Last Name</strong></th>
            <th style='text-align:center'><strong>Username</strong></th>
            <th style='text-align:center'><strong>Position</strong></th>
          </tr>
        </thead>
        <tbody>
    EOD;
    $str .= <<<EOD
    <tr>
      <td style='text-align:center'>$info[0]</td>
      <td style='text-align:center'>$info[1]</td>
      <td style='text-align:center'>$info[2]</td>
      <td style='text-align:center'>$info[3]</td>
      <td style='text-align:center'>$info[4]</td>
    </tr>
       </tbody>
       </table>
        <br>
       </div>
       <form class="changePass">
       <button type="submit" name="action" class="button2"value="changePass">Change Password</button>
       </form>
    EOD;
    echo $str;

  }
  public function valideAddForm(){
$errors=array();
$error=validateEmail($_REQUEST['email']);
if($error!=""){
$errors['email']=$error;

}
if(count($errors)==0){
return false;

} else {
  return $errors;
}
  }
}

?>
