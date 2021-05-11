<?php ob_start(); 
include "nav.php";?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <style>
     body{
      overflow-x: hidden;
      background-color:#DAE3EB;
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
    .submitEmployee{
      position: relative;
      left:510px;
    }
    #bar{
      border-left:none;
      border-right:none;
      border-top:none;
      border-bottom:2px solid black;
      background-color:transparent;
    }
    #select{
      border:2px solid black;
      background-color:transparent;
    }
    </style>
  </head>
  <body>
  <div class="container">
  <h2>Reservations</h2>
    <input type="text" id="bar" placeholder="Search by..." oninput="showClient()">
    <select id="select" onchange="showClient()">
      <option value="last_name">Last Name</option>
      <option value="identification_no">ID Number</option>
      <option value="company">Company</option>
    </select>
    <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
      <thead>
        <tr>
          <th><strong>First Name</strong></th>
          <th><strong>Last Name</strong></th>
          <th><strong>Nationality</strong></th>
          <th><strong>Identification No.</strong></th>
          <th><strong>Mobile</strong></th>
          <th><strong>E-mail</strong></th>
          <th><strong>Company</strong></th>
        </tr>
      </thead>
      <tbody id="rTable">
      </tbody>
    </table>
    </div>
  </body>
</html>
<?php
ob_end_flush();
?>