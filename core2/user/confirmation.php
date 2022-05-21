
<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "db.php";
    // Prepare a select statement
    $sql = "SELECT * FROM core2_add WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        

        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
              
               
                $type = $row["type"]; 
                $seat_cap = $row["seat_cap"];  
                $base_price = $row["base_price"];
                
                    
     
   
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
   
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link rel="shortcut icon" type="image/jpg" href="../assets/img/philtransure_icon.png" />
    <title>Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="design.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style type="text/css">
          th, td{
               text-align: center;
                 }
    </style>
</head>
<body>

        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                         
                    <h2 class="mt-5 mb-3">
                    <button onclick="history.back()" class="btn btn-success"style=" margin-top: 10px; margin-bottom: 10px; font-size: 30px; background-color: white; color: #0d6efd; border: none; "><h2>Back</h2></button> / Summary Details</h2>


  <?php
     session_start();
     $destination = $_SESSION["destination"];
     $destination_address = $_SESSION["destination_address"];
     $c = $_SESSION["c"];
     $e = $_SESSION["e"];
    
     $totals = $_SESSION["totals"];
    

                    // vehicle sumarry
                    require_once "db.php";
                    

                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                       

                                        echo "<th>Type</th>";
                                        echo "<th>Seating Capacity</th>";
                                        echo "<th>Base Price</th>";
                                        
                                       
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                    echo "<tr>";

                                         echo "<td>" . $row['type'] . "</td>";

                                             $_SESSION["type"] =  $row['type'];

                                         echo "<td>" . $row['seat_cap'] . "</td>";

                                             $_SESSION["seat_cap"] =  $row['seat_cap'];

                                         echo "<td>". '₱ ' . $row['base_price'] . "</td>";

                                             $_SESSION["base_price"] =  $row['base_price'];

                                        


                                           
                                    echo "</tr>";
                                
                                echo "</tbody>";                            
                            echo "</table>";


                            // Destination summary


                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                       
                                        echo "<th> Destination</th>";
                                        echo "<th>Destination Address</th>";
                                        echo "<th>Distance In km</th>";   
                                        echo "<th>Time Duration</th>";

    
                                        
                                       
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                    echo "<tr>";
                                        echo "<td>" . $destination . "</td>";
                                        
                                        echo "<td>" . $destination_address . "</td>";
                                          echo "<td>" . $c . ' Km'. "</td>";
                                        echo "<td>" . $e . ' Min' . "</td>";
          
                                    echo "</tr>";
                                
                                echo "</tbody>";                            
                            echo "</table>";


                    ?>  


                                      
                                        
                             


</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
         <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
           <div class="container">

      <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#caseaddmodal" 
      style="background-color: #0d6efd; 
       
      color: black; 
      display: block;
      margin-top: 20px;
      margin-left: auto;
      margin-right: auto;
      height: 6vh;
      color: white;
      border-color: blue;
      width: 40%;"> Choose Payment</button></center>
          </div>

         <!-- payment modal -->
    <div class="modal fade" id="caseaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
        <div class="hero"> 
            <div class="modal-content" style="background-color: transparent; border: 0px;"> 
            <div class="form-box" style="height: 450px;">       
    

    <br>
    <br>
    <center><h3 style="color: black; font-family: sans-serif;|"><i>Payment Method</i></h3></center>

     <div class="button-box">

         <div id="btn"></div>
            <button type="button" class="toggle-btn" onclick="login()">Cash</button>
            <button type="button" class="toggle-btn" onclick="register()">E Wallet</button>
         </div>
                      
            <!-- Cash -->
        <form id="login"  action="history.php" method="POST" class="input-group"  style="justify-content: center;">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <button type="submit" name="save" class="submit-btn" >CASH</button>
      
        </form>

        <!-- TOTALS -->      
        <center><h4><em>Total Cost: <?php   
            $base_price = $_SESSION["base_price"]; 
            $total_cost = $base_price + $totals; 
            $_SESSION["total_cost"] =  $total_cost;

            echo  '₱'. $total_cost; 


            ?> </em></h4>
        </center>
        
            <!-- e-wallet -->
        <form id="register"  action="" method="POST" class="input-group" style="justify-content: center;">
        <br><br><br><br><br><br><br><br>
        <center>
            <br><br><br>
              <?php
                              require_once "db.php";
                                $query = "SELECT * FROM customer_accounts where customer_email = '$_SESSION[customer_email]' ";
                                $query_run = mysqli_query($conn, $query);

                           
                                if($query_run)
                                {
                                    foreach($query_run as $row)
                                    {
                                        ?>
                                       
            <h4 style="color: black;"><em>Balance: <?php  echo "₱ " .$row['balance']; ?></em></h4></center>

                                        <?php
                                     }
                                }
                            ?>
        <button onclick="myFunction()" type="" class="submit-btn">E-WALLET</button>
        </form>

<script>
function myFunction() {
  alert("Sorry!!! Feature Not Ready.");
}
</script>



    <div class="modal-footer">

    <button type="button" class="" data-dismiss="modal" style="background-color: #e6e6e6; border: none; outline: none; position:relative; left:-2px; bottom: 240px; font-size: 25px">&times;</button>
      
        </div>

    
    <script>
            var x = document.getElementById("login");
            var y = document.getElementById("register");
            var z = document.getElementById("btn");
            function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
            }
            function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
}

</script>
           
            </div>
        </div>
    </div>

  
            <!-- /#page-wrapper -->

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/js/jquery.overlayScrollbars.min.js"></script>




   </div>        
        </div>
    </div>
</body>
</html>