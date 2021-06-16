<?php
include "nav.php"
?>
<html>
  <head>
    <meta charset="utf-8">
    <script src="JS/employees.js"></script>
  </head>
  <style>
    body{
      overflow-x: hidden;
      background-color:#FFE7E7;
    }
    table,th,td,tr{
      border:1px solid black;
      font-family: "Times New Roman", Times, serif;
    }
    th,td{
      padding: 15px;
      text-align: left;
      border:none;
    }
    tr:hover{
      background-color:#bdc7c9;
    }
    th{
      background-color:#845460;
      color: white;
    }
    table{
      width: 100%;
      position:relative;
    }
    tr:hover{
      color:blue;
    }
    h2{
      text-align:center;
      margin-top:20px;
      margin-bottom:20px;
    }
    .button{
      position: relative;
      margin-top:10px;
      width:100%;   
      background-color:#845460;
      height:50px;
      font-weight:bolder;
    }
    .button:hover{
      background-color:#7b113a;
      color:white;
      border:1px solid black;
    }
    .formE{
      margin-top:15px;
      height:55px;
    }
  </style>
<body onload="showEmployees()">
  <div class="container">
    <h2>Employees</h2>
    <div id="addEmployees" style="display: none">
      <form class="addE"  action="" method="post">
        <input type="text" name="Fname" id="Fname" class="formE form-control mb-4 border-0 py-4" placeholder="First Name"><br>
        <input type="text" name="Lname" id="Lname" class="formE form-control mb-4 border-0 py-4" placeholder="Last Name"><br>
        <input type="password" name="password" id="password" class="formE form-control mb-4 border-0 py-4"placeholder="Password"><br>
        <input type="text" name="username" id="username" class="formE form-control mb-4 border-0 py-4" placeholder="UserName"><br>
        <select id="position" name="position" class="formE form-control mb-2 border-0">

          <option hidden disabled selected value>Position</option>
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
          <th style='text-align:center'><strong>ID</strong></th>
          <th style='text-align:center'><strong>First Name</strong></th>
          <th style='text-align:center'><strong>Last Name</strong></th>
          <th style='text-align:center'><strong>Username</strong></th>
          <th style='text-align:center'><strong>Position</strong></th>
          <th style='text-align:center'><strong>Edit</strong></th>
          <th style='text-align:center'><strong>Delete</strong></th>
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
