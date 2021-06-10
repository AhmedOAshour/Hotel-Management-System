<?php
class ViewUser extends View{
  public function viewAllUsers(){
    $users = $this->model->readAllUsers();
    $str = <<<EOD
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
            <td><a href="#">Edit</a></td>
            <td><a href="#">Delete</a></td>
          </tr>
          EOD;
        }
      str .= <<<EOD
        </tbody>
      </table>
      <br>
    </div>
    <!-- <button type="button" class="button" id="addBtn" onclick="view_add()">Add Employee</button> -->
    EOD;
  }
}
?>
