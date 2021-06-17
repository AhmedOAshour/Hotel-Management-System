<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>

  </body>
</html>
<?php
class ViewUser extends View{
  public function output(){
    $users = $this->model->readUsers();
    $str =
    <<<EOD
    <h2>Employees</h2>
    <div id="viewEmployees">
      <table>
        <thead>
          <tr>
            <th><strong>ID</strong></th>
            <th><strong>First Name</strong></th>
            <th><strong>Last Name</strong></th>
            <th><strong>Username</strong></th>
            <th><strong>Position</strong></th>
            <th><strong>Edit</strong></th>
            <th><strong>Delete</strong></th>
          </tr>
        </thead>
        <tbody>
    EOD;
        foreach ($users as $user) {
          $str .= <<<EOD
          <tr>
            <td>$user->id</td>
            <td>$user->first_name</td>
            <td>$user->last_name</td>
            <td>$user->username</td>
            <td>$user->position</td>
            <td><a href="employees.php?action=editform&id=$user->id">Edit</a></td>
            <td><a href="employees.php?action=delete&id=$user->id">Delete</a></td>
          </tr>
          EOD;
        }
    $str .= <<<EOD
        </tbody>
      </table>
      <br>
    </div>
    <a href="employees.php?action=addform"><button type="button" class="button" id="addBtn">Add Employee</button></a>
    EOD;
    echo $str;
  }
  public function addForm(){
    $str=<<<EOD
    <form class="addE" oninput="checkAddEdit()">
    <div id="addEmployees" class="addEmployees">
        <div id="errorName1">
        </div>
        <input type="text" name="first_name" id="Fname" class="form form-control mb-4 border-0 py-4" placeholder="First Name" required><br>
        <div id="errorName2">
        </div>
        <input type="text" name="last_name" id="Lname" class="form form-control mb-4 border-0 py-4" placeholder="Last Name" required><br>
        <div id="errorUsername">
        </div>
        <input type="text" name="username" id="username" class="form form-control mb-4 border-0 py-4" placeholder="Username" required><br>
        <div id="errorPass">
        </div>
        <input type="password" name="password" id="password" class="form form-control mb-4 border-0 py-4"placeholder="Password" required><br>
        <select id="position" name="position" class="form form-control mb-2 border-0">
          <option hidden disabled selected value>Position</option>
          <option value='front_clerk'>Front Clerk</option>
          <option value='reservation_clerk'>Reservation Clerk</option>
          <option value='HK_employee'>Housekeeping</option>
        </select><br>
        <input type="submit" class="submitEmployee button" name="action" value="add" id="submitBtn">
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function editForm($id){
    $user = new User($id);
      $str=<<<EOD
      <form class="editE" oninput="checkAddEdit()">
        <input type="text" name="id" value="$id" style="display:none">
        <label class='names' for='first_name'>First Name</label><input type='text' name='first_name' id='Fname' class='formE form-control border-0 ' value='$user->first_name' '> <br><br>
        <div id="errorName1">
        </div>
        <label class='names' for='last_name'>Last Name</label><input type='text' name='last_name' id='Lname' class='formE form-control border-0 ' value='$user->last_name' '> <br><br>
        <div id="errorName2">
        </div>
        <label class='names' for='username'>username</label><input type='text' name='username' id='username' class='formE form-control border-0 ' value='$user->username' '> <br><br>
        <div id="errorUsername">
        </div>
        <label class='names' for='password'>password</label><input type='password' name='password' id='password' class='formE form-control  border-0' value='' '> <br><br>
        <div id="errorPass">
        </div>
        <label class='names' for='position'>position</label>
        <select id='position' name='position' class='formE form-control mb-2 border-0'>
        <option value='front_clerk'>Front Clerk</option>
        <option value='reservation_clerk'>Reservation Clerk</option>
        <option value='HK_employee'>HouseKeeping Clerk</option>
        </select> <br><br>
        <input type='submit'  name='action' value="edit" class='button'>
      </form>
      EOD;
      echo $str;
  }
  public function loginForm(){
    $str=<<<EOD
    <div id="login">
    <form class="login">
        <input type="text" name="username" id="username" class="form form-control mb-4 border-0 py-4" placeholder="Username" required><br>
        <input type="password" name="password" id="password" class="form form-control mb-4 border-0 py-4"placeholder="Password" required><br>
        <input type="submit" class="login button" name="action" value="login" id="submitBtn">
        <a href="index.php?action=forgotpass">Forgot Password</a>
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function forgotPass(){
    $str=<<<EOD
    <div id="login">
    <form class="login">
        <label class='username' for='username'>username</label><input type="text" name="username" id="username" class="form form-control mb-4 border-0 py-4" placeholder="Username" required><br>
        <button type='submit' name='action' value='security'>Next</button>
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function security($username){
    $question = $this->model->getQuestion($username);
    $str=<<<EOD
    <div id="login">
    <form class="login">
        <h3>Security Question</h3>
        <label class='question' for='question'>$question ?</label><br><input type="text" name="answer" id="answer" class="form form-control mb-4 border-0 py-4"><br>
        <input type="text" name="username" value="$username" style="display:none;" required>
        <input type="submit" class="forgot" name="action" value="validate" id="submitBtn">
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function newPassword($username){
    $str=<<<EOD
    <div id="login">
    <form class="login">
        <input type="text" name="username" value="$username" style="display:none;" >
        <label class='password' for='password'>New Password</label><br><input type="text" name="password" class="form form-control mb-4 border-0 py-4" required><br>
        <label class='confirmPassword' for='confirmPassword'>Confirm Password</label><br><input type="text" class="confirmP" name="cPassword" required><br>
        <button type="submit" name="action" value="newPass">Submit</button>
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function changePasswordForm(){
    $str=<<<EOD
    <div id="changePass">
    <form class="changePass" oninput="checkNewPass()">
        <label class='oldPass' for='oldPass'>Old Password</label><br><input type="text" name="oldPass" class="form form-control mb-4 border-0 py-4" required><br>
        <label class='newPass' for='newPass'>New Password</label><br><input type="text" name="newPass" id="newPass" class="form form-control mb-4 border-0 py-4" required><br>
        <div id="errorNewPass">
        </div>
        <label class='cNewPass' for='cNewPass'>Confirm New Password</label><br><input type="text" name="cNewPass" id="cNewPass" class="form form-control mb-4 border-0 py-4" required><br>
        <div id="errorCNewPass">
        </div>
        <button type="submit" name="action" value="confirmPass">Submit</button>
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function profile($username){
    $info = $this->model->readprofile();
    $str =
    <<<EOD
    <h2>My Profile</h2>
    <div id="profile">
      <table>
        <thead>
          <tr>
            <th><strong>ID</strong></th>
            <th><strong>First Name</strong></th>
            <th><strong>Last Name</strong></th>
            <th><strong>Username</strong></th>
            <th><strong>Position</strong></th>
          </tr>
        </thead>
        <tbody>
    EOD;
    $str .= <<<EOD
    <tr>
      <td>$info[0]</td>
      <td>$info[1]</td>
      <td>$info[2]</td>
      <td>$info[3]</td>
      <td>$info[4]</td>
    </tr>
       </tbody>
       </table>
        <br>
       </div>
       <form class="changePass">
       <button type="submit" name="action" value="changePass">Change Password</button>
       </form>
    EOD;
    echo $str;
  }
}

?>
