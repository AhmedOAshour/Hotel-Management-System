<?php
include "nav.php";
session_start();
?>
<html lang="en">
<head>

</head>
<style>
    body{
        background-color: #DAE3EB;
    }
    .search{
        width:250px;
        border-top: none;
        border-right: none;
        border-left: none;
    }
    .row{
        background-color:white;
        width:100%;
        margin:0;
        padding-top:10px;
    }
    .bar{
        text-align:left;
    }
    .searchbar{
        text-align:right;
    }
    .left{
        background-color:#EFEBEB;
        width:230px;
        height:590px;
    }
    h3{
        position:relative;
        left:20px;
        color:blue;
    }
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-3 bar">
                <form action="/action_page.php">
                    <label>Date:</label>
                    <input type="date" id="date" name="Date">
                </form>
            </div>
            <div class="col-9 searchbar">
                <input class="search"type="text" placeholder="Search by room or guest's name"><i class="fa fa-search"></i>
            </div>
        </div>
    </div>
    <div class="container">
        <ul class="nav flex-column left">
            <h3>Status</h3>
            <li class="nav-item">
                <input type="checkbox" id="status1" name="status1" value="Reserved">
                <label for="vehicle1">Reserved</label><br>
                <input type="checkbox" id="status2" name="status2" value="Occupied">
                <label for="vehicle1">Occupied</label><br>
                <input type="checkbox" id="status3" name="status3" value="Available">
                <label for="vehicle1">Available</label><br>
                <input type="checkbox" id="status3" name="status3" value="CheckedOut">
                <label for="vehicle1">CheckedOut</label><br>
            </li>
            <h3>Type</h3>
            <li class="nav-item">
                <input type="checkbox" id="Type1" name="Type1" value="Single">
                <label for="vehicle1">Single</label><br>
                <input type="checkbox" id="Type2" name="Type2" value="Double">
                <label for="vehicle1">Double</label><br>
                <input type="checkbox" id="Type3" name="Type3" value="Triple">
                <label for="vehicle1">Triple</label><br>
                <input type="checkbox" id="Type3" name="Type3" value="Family">
                <label for="vehicle1">Family</label><br>
            </li>
            <h3>House Keeping</h3>
            <li class="nav-item">
                <input type="checkbox" id="HouseKeeping1" name="HouseKeeping1" value="Clean">
                <label for="vehicle1">Clean</label><br>
                <input type="checkbox" id="HouseKeeping2" name="HouseKeeping2" value="Notclean">
                <label for="vehicle1">Not clean</label><br>
                <input type="checkbox" id="HouseKeeping3" name="HouseKeeping3" value="Inprogress">
                <label for="vehicle1">In progress</label><br>
            </li>
        </ul>
    </div>
</body>
</html>