<html>
  <head>
    <meta charset="utf-8">
    <title>Admins</title>
    <script src="js/employees.js"></script>
  </head>
<body onload="showEmployees()">
    <h1><u>Employees</u></h1>
    <div id="addEmployees" style="display: none">
      <form class="addE" action="" method="post">
        <label for="Fname">First Name</label> <input type="text" name="Fname" id="Fname" class="form" value="" required style="margin-left:30px;"> <br><br>
        <label for="Lname">Last Name</label> <input type="text" name="Lname" id="Lname" class="form" value="" required style="margin-left:32px;"> <br><br>
        <label for="password">Password</label> <input type="password" name="password" id="password" class="form" value="" required style="margin-left:5.5px;"> <br><br>
        <label for="username">Username</label> <input type="text" name="username" id="username" class="form" value="" required style="margin-left:25px;"> <br><br>
        <label for="position">position</label>
        <select id="position" name="position" class="form" style="margin-left:39.5px;">
        <option value='front_clerk'>Front Clerk</option>
        <option value='reservation_clerk'>Reservation Clerk</option>
        <option value='HK_employee'>Housekeeping</option>
        </select> <br><br>
        <button type="button" class="submitEmployee" name="submitBtn" id="submitBtn" onclick="addEmployee()">Submit</button>
      </form>
    </div>

    <div id="viewEmployees">
        <label for=""></label> <input type="text" name="searchBar" id="searchBar" class="form" oninput="showEmployees()" placeholder="Search for Employee.." style="margin-left:10px;width:170px;">
        <select name="searchBy" id="searchBy" class="form" onchange="showEmployees()" style="width:70px;">
        <option value="ID">ID</option>
        <option value="Name">Name</option>
        <option value="position">position</option>
        </select>

    <table width="100%" border="1" style="border-collapse:collapse;" c>
      <thead>
        <tr>
          <th><strong>ID</strong></th>
          <th><strong>First Name</strong></th>
          <th><strong>Last Name</strong></th>
          <th><strong>Username</strong></th>
          <th><strong>position</strong></th>
        </tr>
      </thead>
      <tbody id="rTable">
      </tbody>
    </table><br>
</div>
<!-- <div id="editEmployees" style="display: none">
  <form class="editE" action="" method="post">
    <label for="Fname">First Name</label> <input type="text" name="FnameE" id="FnameE" class="formE" value="" required style="margin-left:30px;"> <br><br>
    <label for="Lname">Last Name</label> <input type="text" name="LnameE" id="LnameE" class="formE" value="" required style="margin-left:32px;"> <br><br>
    <label for="password">Password</label> <input type="password" name="passwordE" id="passwordE" class="formE" value="" required style="margin-left:5.5px;"> <br><br>
    <label for="username">Username</label> <input type="text" name="usernameE" id="usernameE" class="formE" value="" required style="margin-left:25px;"> <br><br>
    <label for="position">position</label>
    <select id="position" name="position" class="formE" style="margin-left:39.5px;">
    <option value='position'>Housekeeping</option>
    <option value='position'>Front Office</option>
    <option value='position'>Reservation Clerk</option>
    </select> <br><br>
    <button type="button" class="submitEmployee" name="submitBtn" id="submitBtn" onclick="editEmployee()">Submit</button>
  </form>
</div> -->
<button type="button" class="addE" id="addBtn" onclick="view_add()">Add Employee</button>
  </body>
</html>

<style media="screen">
*{
  margin:0;
  padding:0;
  font-family: Century Gothic;
}

body{
  background-size: cover;
  background-position:center;
  background-repeat: no-repeat;
}

h1{
  margin-left: 45%;
  color: Black;
}

table{
  background-color: lightgrey;
  margin-top: 10px;
}

.addE{
  border:0;
  background: none;
  display: block;
  margin-left: 10px;
  text-align: center;
  padding: 14px 40px;
  outline: none;
  color: blue;
  border-radius: 24px;
  transition: 0.25s;
  cursor:pointer;
}

/* .addE:hover{
  background:black;
} */

.submitEmployee{
  border:0;
  background: none;
  display: block;
  text-align: center;
  margin-left: 7px;
  margin-bottom: 5px;
  /* border: 2px solid black; */
  padding: 14px 40px;
  outline: none;
  color: blue;
  border-radius: 24px;
  transition: 0.25s;
  cursor:pointer;
}

/* .submitEmployee:hover{
  background: black;
} */

</style>
