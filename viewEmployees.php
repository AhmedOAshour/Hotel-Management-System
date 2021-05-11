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
      background-color:#DAE3EB;
    }
    table,th,td,tr{
      border:1px solid black;
      font-family: "Times New Roman", Times, serif;
    }
    th,td{
      padding: 15px;
      text-align: left;
    }
    th{
      background-color:#36486b;
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
      bottom: 35px;
      font-size: 1.25em;
      font-weight: 700;
      color: white;
      background-color: #36486b;
      display: inline-block;
      cursor: pointer;
      border: 1px solid black;
      top:10px;
    }
    .button:focus,
    .button:hover{
      filter: brightness(150%);
    }
    #addBtn{
      position: relative;
      left:470px;
    }
    .submitEmployee{
      position: relative;
      left:510px;
    }
  </style>
<body onload="showEmployees()">
  <div class="container">
    <h2>Employees</h2>
    <div id="addEmployees" style="display: none">
      <form class="addE"  action="" method="post">
        <input type="text" name="Fname" id="Fname" class="form form-control mb-4 border-0 py-4" placeholder="First Name"><br>
        <input type="text" name="Lname" id="Lname" class="form form-control mb-4 border-0 py-4" placeholder="Last Name"><br>
        <input type="password" name="password" id="password" class="form form-control mb-4 border-0 py-4"placeholder="Password"><br>
        <input type="text" name="username" id="username" class="form form-control mb-4 border-0 py-4" placeholder="UserName"><br>
        <select id="position" name="position" class="form form-control mb-2 border-0">

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
          <th><strong>ID</strong></th>
          <th><strong>First Name</strong></th>
          <th><strong>Last Name</strong></th>
          <th><strong>Username</strong></th>
          <th><strong>Position</strong></th>
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
