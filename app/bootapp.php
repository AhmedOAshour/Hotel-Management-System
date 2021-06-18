<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/typeit@7.0.4/dist/typeit.min.js"></script>
<link rel="stylesheet" href="css/master.css">
<?php
// Load Config
session_start();
require_once 'config/config.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Database.php';
require_once 'libraries/Model.php';
require_once 'libraries/View.php';
require_once 'views/inc/nav.php';


//Autoload Core Libraries
//spl_autoload_register(function ($className) {
  // require_once 'libraries/' . $className . '.php';
// });

?>
