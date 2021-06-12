<?php ob_start();
session_start();
  ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/typeit@7.0.4/dist/typeit.min.js"></script>
</head>
<style>
    .navbar-light .navbar-brand{
        font-size: 30px;
        font-family:fantasy;
    }
    .nav-item{
        padding-left: 50px;
    }
    .navcolor{
        background-color:#845460;
    }
    .navbar-light .navbar-nav .nav-link{
        color:white;
    }
</style>
<body>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light navcolor">
            <a class="navbar-brand"><img src="logo2.png" width="80px"></a>
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
    </div>
</body>
</html>
<?php ob_end_flush();?>