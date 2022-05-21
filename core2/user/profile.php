<?php 
session_start();


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

    <title>Profile</title>
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

    <div class="row">
        <div class="col-md-3 border-right" style="margin-bottom: 90vh;">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="200px" height="200px;" src="img/profile.png"><span class="font-weight-bold">E-MAIL</span><span class="text-black-50"><?php echo $_SESSION['customer_email'] ?></span><span> </span></div> 
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4> 
                </div>
                <hr>
            <?php
            require_once "db.php";
             $sql = "SELECT * FROM customer_accounts where customer_email = '$_SESSION[customer_email]'";
                 if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){  ?> 
                    
        <div class="row mt-3">
          <div class="col-md-12 mb-3"><label class="labels"><strong><span style="color:#000;">First Name: </span>   </strong>  <?php echo $row['customer_fname']; ?>  </label></div>

          <div class="col-md-12 mb-3"><label class="labels"><strong><span style="color:#000;">Last Name: </span>    </strong> <?php echo $row['customer_lname']; ?> </label></div>

          <div class="col-md-12 mb-3"><label class="labels"><strong><span style="color:#000;">Email :</span>    </strong> <?php echo $_SESSION['customer_email'] ?> </label></div>

             </div>
 
             
                                         <?php      

                          }
                              
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                   
                ?>

                 <?php
                              require_once "db.php";
                                $query = "SELECT * FROM customer_accounts where customer_email = '$_SESSION[customer_email]' ";
                                $query_run = mysqli_query($conn, $query);

                           
                                if($query_run)
                                {
                                    foreach($query_run as $row)
                                    {
                                        ?>
                                <div class="col-md-12 mb-3"><label class="labels"><strong><span style="color:#000;">Balance :</span>    </strong> <?php  echo "₱ " .$row['balance']; ?> </label></div>
           

                                        <?php
                                     }
                                }
                            ?>


     <hr>  

                  
                
        <div class="col-md-3 border-right">
           <!-- <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img style="position:absolute; top:370px;left:550px;" width="750px" height="360px;" src="img/profile1.png">-->
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