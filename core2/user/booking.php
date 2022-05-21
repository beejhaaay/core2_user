<?php 
session_start();
if (isset($_SESSION['customer_email'])) {

 ?>
<!doctype html>
<!-- 
* Bootstrap Simple Admin Template
* Version: 2.1
* Author: Alexis Luna
* Website: https://github.com/alexis-luna/bootstrap-simple-admin-template
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" type="image/jpg" href="../assets/img/philtransure_icon.png" />

    <title>Booking</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">
      <script src='https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css' rel='stylesheet' />
  <!-- <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css"> -->
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
</head>
<style>
body,h3 {
  font-family: Arial, Helvetica, sans-serif;
  margin-right: 815px;
  margin-top: 5px;
}
.p3 {.
   font-family: Lucida Console;
 color: grey;
  font-size: 30px;
 text-align: center;
 margin-top: 5px;
}

</style>

<body>
    <div class="wrapper">
          <?php require_once "user_sidebar.php" ?>
             <div id="body" class="active">
            <!-- navbar navigation component -->
            <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> <span><?php echo $_SESSION['customer_email'] ?></span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="profile.php" class="dropdown-item"><i class="fas fa-address-card"></i> Profile</a></li>
                                        <li><a href="../../customer/logout.php"  
    onclick="return confirm('Are you sure you want to logout?');" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                       
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

       
              <style>
 html, body 
{ 
 height: 100%;
 overflow: hidden
}
    #map {
      height: 82vh;
      
      margin: 0;
    }

    #click_button {
      display: block;
      margin-top: 20px;
      margin-left: auto;
      margin-right: auto;
      height: 6vh;
      width: 60%;
      color: white;
      background-color: #0d6efd; 
      border-color: blue; 
      position:relative; 
      bottom: 15px;
    }
  </style>
  <script src="assets/js/c_code.js" defer></script>
</head>

<body>
  <div class="wrapper">
    <div id="body" class="active">
      <div class="content">
        <div class="container-fluid">
          <div class="page-title">

          </div>
          <div id="map_container">
            <div id='map'></div>
          </div>
          <div>
            <button id="click_button">PROCEED</button>
          </div>
        </div>
      </div>
    </div>
  </div>
                <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chartsjs/Chart.min.js"></script>
    <script src="assets/js/dashboard-charts.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>

<?php 
}else{
     header("Location: ../../customer/index.php");
     exit();
}
 ?>