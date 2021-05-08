<?php
include "nav.php"
?>
<html>
  <head>
    <meta charset="utf-8">
    <script src="js/employees.js"></script>
  </head>
  <style>
body{
  overflow-x: hidden;
}
table,th,td,tr{
  border:1px solid black;
}
th,td{
  padding: 15px;
  text-align: left;
}
th{
  background-color: grey;
  color: white;
}
table{
  width: 100%;
  position:relative;
}
h2{
  text-align:center;
  margin-top:20px;
  margin-bottom:20px;
}
.button{
  position: relative;
  bottom: 35px;
  font-size: 1.25em;
  font-weight: 700;
  color: white;
  background-color: grey;
  display: inline-block;
  cursor: pointer;
  border: 1px solid black;
  top:10px;
}
.button:focus,
.button:hover{
  background-color: rgb(121, 117, 117);
}
#addBtn{
  position: relative;
  left:470px;
}
  </style>
<body onload="showEmployees()">
  <div class="container">
    <h2>Employees</h2>
    <div id="addEmployees" style="display: none">
      <form class="addE" action="" method="post">
        <label for="Fname">First Name</label><input type="text" name="Fname" id="Fname" class="form"><br>
        <label for="Lname">Last Name</label> <input type="text" name="Lname" id="Lname" class="form"><br>
        <label for="password">Password</label> <input type="password" name="password" id="password"><br>
        <label for="username">Username</label> <input type="text" name="username" id="username" class="form"><br>
        <label for="position">position</label>
        <select id="position" name="position" class="form">
          <option value='front_clerk'>Front Clerk</option>
          <option value='reservation_clerk'>Reservation Clerk</option>
          <option value='HK_employee'>Housekeeping</option>
        </select><br>
        <button type="button" class="submitEmployee button" name="submitBtn" id="submitBtn" onclick="addEmployee()">Submit</button>
      </form>
    </div>
    <div id="viewEmployees">
    <table>
      <thead>
        <tr>
          <th><strong>ID</strong></th>
          <th><strong>First Name</strong></th>
          <th><strong>Last Name</strong></th>
          <th><strong>Username</strong></th>
          <th><strong>position</strong></th>
          <th><strong>Edit</strong></th>
          <th><strong>Delete</strong></th>
        </tr>
      </thead>
      <tbody id="rTable"></tbody>
    </table>
    <br>
</div>
<button type="button" class="button" id="addBtn" onclick="view_add()">Add Employee</button>
</div>
  </body>
</html>


