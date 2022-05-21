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
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

  
    <link rel="shortcut icon" type="image/jpg" href="../assets/img/philtransure_icon.png" />

    <title>History</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>
<style>

.p3 {.
   font-family: Lucida Console;
 color: grey;
  font-size: 30px;
 text-align: center;
 margin-top: 5px;
}
table {

  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;

}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>
    <div class="wrapper">
          <?php require_once "user_sidebar.php" ?>
       
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
                    <!-- Export link -->
<div class="col-md-12 head" >
    <div class="float-right" >
        
    </div>

            <!-- end of navbar navigation -->
            <?php 
                 require_once "db.php";
                   $sql = "SELECT * FROM core2_history where c_user = '$_SESSION[customer_email]' AND status = 'Accepted'";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                 echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                       
                                        echo "<th>Time and Date</th>";
                                        echo "<th>Plate No.</th>";
                                        echo "<th>Vehicle Type</th>";
                                        echo "<th>Vehicle Brand</th>";
                                        echo "<th>Vehicle Model</th>";
                                        echo "<th>Seating Capacity</th>";
                                        echo "<th>Driver Phone No.</th>";
                                        echo "<th>Base Price</th>";
                                        echo "<th>Destination</th>";
                                        echo "<th>Address</th>";
                                        echo "<th>Distance in KM</th>";
                                        echo "<th>Time Duration</th>";
                                        echo "<th>Total Cost</th>";
                                        
                                        
                                        
                                       
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                     while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['completed_time'] . "</td>";
                                        echo "<td>" . $row['plateno'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                          echo "<td>" . $row['vehicle_brand'] . "</td>";
                                        echo "<td>" . $row['vehicle_model'] . "</td>";
                                         echo "<td>" . $row['seat_cap'] . "</td>";
                                          echo "<td>" . $row['core1_driver_phoneno'] . "</td>";
                                          echo "<td>" . '₱ '.  $row['base_price']. "</td>";
                                          echo "<td>" . $row['destination']. "</td>";
                                         echo "<td>" . $row['address']. "</td>";
                                         echo "<td>" . $row['distance']. ' KM' ."</td>";
                                         echo "<td>" . $row['time']. ' MIN'. "</td>";
                                         echo "<td>" . '₱ '. $row['total_cost']. "</td>";


                                           
                                    echo "</tr>";
                                                                 }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                   

?>



            


    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form-validator.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>

<?php 
}else{
     header("Location: ../../customer/index.php");
     exit();
}
 ?>