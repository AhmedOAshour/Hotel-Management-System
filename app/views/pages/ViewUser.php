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
  .errors{
      color:red;
      position: relative;
      left:270px;
      bottom:45px;
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
    if($users){
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
    }
    else {
      $str.= <<<EOD
      <tr><td>No Results</td></tr>
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
    
    $fname="";
    $lname="";
    $uname="";
    $password="";
    $squestion="";
    $sanswer="";
    $position="";
    $username1="";
    
  
    if(isset($_SESSION['errors'])){
      $errors=$_SESSION['errors'];
      
      if(isset($errors['fname'])){
        $fname=$errors['fname'];
                                  }
      if(isset($errors['uname'])){
      $uname=$errors['username'];
  
      }
      
      if(isset($errors['lname'])){
         $lname=$errors['lname'];
                                  }
      if(isset($errors['position'])){
          $position=$errors['position'];
                               }
      if(isset($errors['squestion'])){
          $squestion=$errors['squestion'];
                              }
       if(isset($errors['sanswer'])){
         $sanswer=$errors['sanswer'];
                                    }
         if(isset($errors['password'])){
           $password=$errors['password'];
                                        }
        if(isset($errors['username1'])){
         $username1=$errors['username1'];
                                      }
        
  
  
    }
  unset($_SESSION['errors']);
    $str=<<<EOD
    <div class="container">
    <h1>Add Employee</h1>
    <form class="addE">
    <div id="addEmployees" class="addEmployees">
        <input type="text" name="first_name" id="Fname" onchange="checkfName()" class="formE form-control mb-4 border-0 py-4" placeholder="First Name" required><br>
        <div id="errorName1"></div>
        <h5 class="errors">$fname</h5>

        <input type="text" name="last_name" id="Lname" onchange="checklName()" class="formE form-control mb-4 border-0 py-4" placeholder="Last Name" required><br>
        <div id="errorName2"></div>
        <h5 class="errors">$lname</h5>

        <input type="text" name="username" id="username" onchange="checkUsername()" class="formE form-control mb-4 border-0 py-4" placeholder="Username" required><br>
        <div id="errorUsername"></div>
        <h5 class="errors">$uname</h5>
        <h5 class="errors">$username1</h5>

        <input type="password" name="password" id="password" oninput="checkPassword()" class="formE form-control mb-4 border-0 py-4"placeholder="Password" required><br>
        <div id="errorPass"></div>
        <h5 class="errors">$password</h5>

        <input type="text" name="sQuestion" id="sQuestion" class="formE form-control mb-4 border-0 py-4"placeholder="Security Question" required><br>
        <h5 class="errors">$squestion</h5>

        <input type="text" name="sAnswer" id="sAnswer" class="formE form-control mb-4 border-0 py-4"placeholder="Security Answer" required><br>
        <h5 class="errors">$sanswer</h5>

        <select id="position" name="position" class="formE form-control mb-2 border-0" required>
          <option hidden disabled selected value>Position</option>
          <option value='admin'>admin</option>
          <option value='front_clerk'>Front Clerk</option>
          <option value='HK_employee'>Housekeeping</option>
        </select><br>
        <h5 class="errors">$position</h5>

        <input type="submit" class="submitEmployee button2" name="action" value="Add" id="submitBtn">
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function editForm($id){
    unset($_SESSION['CID']);
    $fname="";
    $lname="";
    $uname="";
    $password="";
    $squestion="";
    $sanswer="";
    $position="";
    $username1="";
    
  
    if(isset($_SESSION['errors'])){
      $errors=$_SESSION['errors'];
      
      if(isset($errors['fname'])){
        $fname=$errors['fname'];
                                  }
      if(isset($errors['uname'])){
      $uname=$errors['username'];
  
      }
      
      if(isset($errors['lname'])){
         $lname=$errors['lname'];
                                  }
      if(isset($errors['position'])){
          $position=$errors['position'];
                               }
      if(isset($errors['squestion'])){
          $squestion=$errors['squestion'];
                              }
       if(isset($errors['sanswer'])){
         $sanswer=$errors['sanswer'];
                                    }
         if(isset($errors['password'])){
           $password=$errors['password'];
                                        }
        if(isset($errors['username1'])){
         $username1=$errors['username1'];
                                      }
        
  
  
    }
  unset($_SESSION['errors']);
  $user = new User($id);
 
  if(!isset($_SESSION['CID'])){
$_SESSION['CID']=$id;

  }
  echo $id;
  
      $str=<<<EOD
      <div class="container">
      <h1>Edit Employees</h1>
      <form class="editE">
        <input type="text" name="id" value="$_SESSION[CID]" style="display:none">
        <h5 class='words' for='first_name'>First Name</h5><input type='text' required name='first_name' id='Fname' onchange="checkfName()" class='formE form-control mb-4 border-0' value='$user->first_name' '> <br><br>
        <div id="errorName1"></div>
        <h5 class="errors">$fname</h5>

        <h5 class='words' for='last_name'>Last Name</h5><input type='text' required name='last_name' id='Lname' onchange="checklName()" class='formE form-control mb-4 border-0' value='$user->last_name' '> <br><br>
        <div id="errorName2"></div>
        <h5 class="errors">$lname</h5>
       
       
        <h5 class='words' for='username'>Username</h5><input type='text' required name='username' id='username' onchange="checkUsername()" class='formE form-control mb-4 border-0' value='$user->username' '> <br><br>
        <div id="errorUsername"></div>
        <h5 class="errors">$uname</h5>
        <h5 class="errors">$username1</h5>

        <h5 class='words' for='password'>Password</h5><input type='password' required name='password' id='password' oninput="checkPassword()" class='formE form-control mb-4 border-0' value='' '> <br><br>
        <h5 class="errors">$password</h5>
        <div id="errorPass"></div>
       
        <h5 class='words arr' for='sQuestion'>Security<br>Question</h5><input type='text' required name='sQuestion' id='sQuestion' class='formE form-control mb-4 border-0 py-4' value='$user->sQuestion' '> <br><br>
        <h5 class="errors">$squestion</h5>

        <h5 class='words' for='sAnswer'>Security Answer</h5><input type='text' required name='sAnswer' id='sAnswer' class='formE form-control mb-4 border-0 py-4' value='$user->sAnswer' '> <br><br>
        <h5 class="errors">$sanswer</h5>

        <h5 class='words' for='position'>Position</h5>
        <h5 class="errors">$position</h5>
        <select id='position' name='position' class='formE form-control mb-4 border-0 py-2'>
        <option value='front_clerk'>Front Clerk</option>
        <option value='reservation_clerk'>Reservation Clerk</option>
        <option value='HK_employee'>HouseKeeping Clerk</option>
        </select> <br>
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
        <button type='submit' name='action' class="button2" value='security'>Next</button>
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
        <input type="submit" class="button2" name="action" value="Validate" id="submitBtn">
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function newPassword($username){
    $str=<<<EOD
    <div class="container">
    <h1>Change Password</h1>
    <div id="changePass">
    <form class="changePass">
        <input type="text" name="username" value="$username" style="display:none;" >
        <input type="password" name="password" id="password" onchange="checkPassword()" placeholder="New Password" class="formE form-control mb-4 border-0 py-4" required><br>
        <div id="errorPass">
        </div>
        <input type="password" class="formE form-control mb-4 border-0 py-4 confirmP" placeholder="Confirm New Password"id="cPassword" oninput="checkConfirmPass()" name="cPassword" required><br>
        <div id="errorCPass">
        </div>
        <button type="submit" name="action" class="button2"value="newPass">Submit</button>
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
    <form class="changePass">
        <input type="text" name="oldPass" placeholder="Old Password" class="formE form-control mb-4 border-0 py-4" required><br>
        <input type="text" name="newPass" id="password" placeholder="New Password" onchange="checkPassword()" class="formE form-control mb-4 border-0 py-4" required><br>
        <div id="errorPass">
        </div>
        <input type="text" name="cNewPass" id="cPassword" oninput="checkConfirmPass()" oninput="checkConfirmPass()" placeholder="Confirm New Password"class="formE form-control mb-4 border-0 py-4" required><br>
        <div id="errorCPass">
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
