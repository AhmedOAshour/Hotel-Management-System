<?php ob_start();
  ?>

<body>

    
        <nav class="navbar navbar-expand-lg navbar-light navcolor">
            <img src="../app/views/images/logo1.png" class="logo">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
              <?php if(!empty($_SESSION['Role'])&& $_SESSION['Role']=='front_clerk') {?>
                <li class="nav-item">
                  <a class="nav-link" href="Rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="createReservation.php">Reservation</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="viewReservations.php">View Reservations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">CheckOut</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Malfunctions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signout.php">Sign out</a>
                </li>
                <?php }
                
                else if(!empty($_SESSION['Role'])&& $_SESSION['Role']=='admin'){ ?>
                 <li class="nav-item">
                    <a class="nav-link" href="viewEmployees.php">View Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signout.php">Sign out</a>
                </li>
                <?php }
                 ?>
            </ul>
            </div>
          </nav>
    
</body>
</html>
<?php ob_end_flush();?>