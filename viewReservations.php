<?php ob_start();
include "nav.php";?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <style>
       body{
        overflow-x: hidden;
        background-color:#ead3cb;
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
    a{

      color:#36486b;
    
      font-family: "Times New Roman", Times, serif;
    }
    a:hover{

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
    <script type="text/javascript">
      function showReservations(){
        var bar = document.getElementById("bar");
        var select = document.getElementById("select");
        var formData = new FormData();
        formData.append('bar', bar.value);
        formData.append('select', select.value);
        formData.append('q', 'show');
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("rTable").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("POST","php/reservations.php",true);
        xmlhttp.send(formData);
      }
  </script>
  </head>
  <body onload="showReservations()">
  <div class="container">
  <h2>Reservations</h2>
    <input type="text" id="bar" placeholder="Search..." oninput="showReservations()">
    <select id="select" onchange="showClient()">
      <option value="last_name">Last Name</option>
      <option value="identification_no">ID Number</option>
      <option value="company">Company</option>
    </select>

    <input type="date" id="date" value="<?php echo date('Y-m-d'); ?>">
    <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
      <thead>
        <tr>
          <th><strong>First Name</strong></th>
          <th><strong>Last Name</strong></th>
          <th><strong>Nationality</strong></th>
          <th><strong>Room Type</strong></th>
          <th><strong>Room Floor</strong></th>
          <th><strong>Arrival</strong></th>
          <th><strong>Days/Nights</strong></th>
          <th><strong>View reservation</strong></th>
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
