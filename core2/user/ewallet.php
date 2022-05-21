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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="shortcut icon" type="image/jpg" href="../assets/img/philtransure_icon.png" />

    <title>E-Wallet</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<style>
body,h5 {
  font-family: Arial, Helvetica, sans-serif;
  margin-right: 50px;
  margin-top: 5px;
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
            <section class="section-1">
<!-- Modal -->
 <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
    <div class="modal fade" id="topupmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Topup Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="border-color: red;">&times;</span>
                    </button>
                </div>

                <form action="" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Amount </label>
                            <input type="number" name="amount" class="form-control"  placeholder="Enter Amount">
                        </div>
                        <div class="form-group">
                            <label> Card Number </label>
                            <input type="number" name="cc" class="form-control"  placeholder="XXXX-XXXX-XXXX-XXXX">
                        </div>
                        <div class="form-group">
                            <label> Expiry date </label>
                            <input type="date" name="ed" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Security Number </label>
                            <input type="number" name="sn" class="form-control"  placeholder="Enter Card number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Pay</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
                        <center><h3><b>E-WALLET</b></h3></center>

                            <?php
                             echo '<table class="table table-bordered table-striped">';

                                echo "<thead>";
                                    echo "<tr>";
                                     echo "<th>Current Balance</th>";
                                     echo "<th>Add Balance &nbsp;</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                              require_once "db.php";
                                $query = "SELECT * FROM customer_accounts where customer_email= '$_SESSION[customer_email]'";
                                $query_run = mysqli_query($conn, $query);

                            ?>
                            <?php
                                if($query_run)
                                {
                                    foreach($query_run as $row)
                                    {
                                        ?>
                                            <tr>
                                         <td> <?php echo "₱ " .$row['balance'];  $_SESSION["balance"] =  $row['balance']; ?></td> 
                                         <td>       
                      <button type="button" class="" data-toggle="modal" data-target="#topupmodal" style="  
                          background-color: transparent; 
                          border: none;
                          color: green; 
                          height: 5vh;
                          border-radius: 4px;
                          width: 7%;"> <i class="fas fa-plus"></i> </button>
                                        </td> 
                                            </tr>
                                
                                         </tbody>                           
                                     </table>

                                        <?php
                                    }
                                }
                            ?>


<?php
require_once "db.php";

if(isset($_POST['insertdata']))
{
    $amount = $_POST['amount'];
    $current_balance = $row ['balance'];
    

    $amount = intval( $amount );
    $current_balance = intval( $current_balance );
    $int_total = $amount + $current_balance;

    $query = "UPDATE customer_accounts SET balance ='$int_total' WHERE customer_email= '$_SESSION[customer_email]'  ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo "<script language='javascript'>";
        echo 'alert("Topup Successfull!");';
        echo 'window.location.replace("ewallet.php");';
        echo "</script>";

    }
    else
    {
        echo '<script> alert("Payment error"); </script>';
    }
}

?>                     
                      
                          
                        </div>                  
                    </div>

                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


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