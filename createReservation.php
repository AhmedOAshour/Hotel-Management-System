<?php ob_start(); 
include "nav.php";?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      border:none;
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
      background-color:#bdc7c9;
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
    .create{
      margin-top:10px;
      width:100%;   
      background-color:#845460;
      height:50px;
      font-weight:bolder; 
    }
    .create:hover{
      background-color:#7b113a;
      color:white;
      border:1px solid black;
    }
    .formE{
      margin-top:15px;
      height:55px;
    }
    
    </style>
    <script type="text/javascript">
      function viewReservation(){
        document.getElementById("client").style.display = "none";
        document.getElementById("reservation").style.display = "block";
      }

      function viewClients(){
        var client = document.getElementById("showClients");
        var form = document.getElementById("createClient");
        if(client.style.display != "none"){
          client.style.display = "none";
          form.style.display = "block";
        }
        else {
          client.style.display = "block";
          form.style.display = "none";
        }
      }

      function showClient(){
        var bar = document.getElementById("bar");
        var select = document.getElementById("select");
        var formData = new FormData();
        formData.append('bar', bar.value);
        formData.append('select', select.value);
        formData.append('q', 'viewC');
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("rTable").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("POST","php/clients.php",true);
        xmlhttp.send(formData);
      }

      function createClient(){
        var elements = document.getElementsByClassName("form");
        var formData = new FormData();
        for (var i = 0; i < elements.length; i++) {
          formData.append(elements[i].name, elements[i].value);
        }
        formData.append('q', 'add');
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            viewClients();
          }
        }
        xmlhttp.open("POST","php/clients.php",true);
        xmlhttp.send(formData);
      }

      function chooseClient(ID){
        document.getElementById("client_ID").value = ID;
        viewReservation();
      }
      </script>
  </head>
  <body onload="showClient()">
  <div class="container mt-3">
  
      <!-- choose or create client section -->
      <div id="client">
        <div id="showClients">
        <input id="bar"type="text" placeholder="Search by..." oninput="showClient()"><i class="fa fa-search"></i>
          <select id="select" onchange="showClient()">
            <option value="last_name">Last Name</option>
            <option value="identification_no">ID Number</option>
            <option value="company">Company</option>
          </select>
          <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
            <thead>
              <tr>
                <th style='text-align:center'><strong>First Name</strong></th>
                <th style='text-align:center'><strong>Last Name</strong></th>
                <th style='text-align:center'><strong>Nationality</strong></th>
                <th style='text-align:center'><strong>Identification No.</strong></th>
                <th style='text-align:center'><strong>Mobile</strong></th>
                <th style='text-align:center'><strong>E-mail</strong></th>
                <th style='text-align:center'><strong>Company</strong></th>
                <th style='text-align:center'><strong>Create Reservation</strong></th>
              </tr>
            </thead>
            <tbody id="rTable">
            </tbody>
          </table>
          <button type="button" class="create" onclick="createClient()">Add Client</button>
        </div>
        <div id="createClient" style="display:none">
          <form action="index.html" method="post">
            <input class="formE form-control border-3" type="text" name="first_name" placeholder="First Name..."><br>
            <input class="formE form-control border-3" type="text" name="last_name" placeholder="Last Name..."><br>
            <input class="formE form-control border-3" type="text" name="identification_no" placeholder="Identification Number..."><br>
            <input class="formE form-control border-3" type="text" name="nationality" placeholder="Nationality..."><br>
            <input class="formE form-control border-3" type="text" name="mobile" placeholder="Mobile..."><br>
            <input class="formE form-control border-3" type="text" name="email" placeholder="E-mail..."><br>
            <input class="formE form-control border-3" type="text" name="company" placeholder="Company..."><br>
            <button class="create"type="button" onclick="createClient()">Submit</button>
          </form>
        </div>
      </div>

      <!-- create reservation section -->
      <div id="reservation" style="display:none">
        <form method="post">
        <input id="count" type='text' name='guest_count' placeholder="Guest Count"><br>
        <textarea name="guest_names" rows="3" cols="23" placeholder="Guest Names seperate by ,"></textarea> <br>
        <label for="room_type">Room Type:</label> <select class="" name="room_type">
          <?php
              $sql = "SELECT DISTINCT type FROM room";
              $conn = new mysqli("localhost", "root", "", "hotel");
              $result = mysqli_query($conn,$sql);
              $conn->close();
              while ($row = mysqli_fetch_array($result)) {
                echo "<option value='$row[type]'>$row[type]</option>";
              }
          ?>
          <option value="">Single</option>
        </select>
        <label for="room_floor">Room Floor:</label> <select class="" name="room_floor">
          <?php
            $sql = "SELECT DISTINCT floor FROM room";
            $conn = new mysqli("localhost", "root", "", "hotel");
            $result = mysqli_query($conn,$sql);
            $conn->close();
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value='$row[floor]'>$row[floor]</option>";
            }
          ?>
        </select>
        Arrival: <input type='date' name='arrival'>
        Departure: <input type='date' name='departure'><br>
        <textarea name="comments" rows="8" cols="80" placeholder="Comments..."></textarea> <br>
        <input type="text" name="client_ID" id="client_ID" hidden>
        <input type="submit" name="submit" value="Submit">
      </form>
    </div>
    </div>
  </body>
</html>


<?php
include "php/classes.php";

$user=new Front_Office();
if(isset($_POST["submit"])){
  $price = 0;
$user->create_reservation($_POST['client_ID'],$_POST['room_type'],$_POST['room_floor'],$_POST['guest_names'],$_POST['guest_count'],$price,$_POST['arrival'],$_POST['departure'],$_POST['comments']);
header("Location: viewReservations.php");
ob_end_flush();
}
?>
