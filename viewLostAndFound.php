<?php ob_start(); 
include "nav.php";?>
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
<body>
    <div class="container mt-3">
        <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
            <thead>
                <tr>
                    <th style='text-align:center'><strong>Date</strong></th>
                    <th style='text-align:center'><strong>Room Number</strong></th>
                    <th style='text-align:center'><strong>Description</strong></th>
                </tr>
            </thead>
            <tbody id="rTable">
            </tbody>
        </table>
    </div>
</body>

<?php
ob_end_flush();

?>