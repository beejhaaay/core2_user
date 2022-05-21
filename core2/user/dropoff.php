<?php session_start(); ?>
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
    <title>Waiting for Dropoff</title>
    <link rel="shortcut icon" type="image/jpg" href="../assets/img/philtransure_icon.png" />
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body onload="myFunction()">
   

    <!-- navbar navigation component -->

    <!-- end of navbar navigation -->
        <div id="body" class="active">
                            <div class="page-title">

 
<?php
 require_once "db.php";
     $destination = $_SESSION["destination"];
     $destination_address = $_SESSION["destination_address"];
     $c = $_SESSION["c"];
     $e = $_SESSION["e"];
     $total_cost = $_SESSION["total_cost"];
     date_default_timezone_set("Asia/Manila"); 
     $time2 = date('Y-m-d H:i:s');
     $type =  $_SESSION["type"];
     $seat_cap =$_SESSION["seat_cap"];
     $base_price =$_SESSION["base_price"];
    
                   
?>
                 
<style type="text/css">
body {
    margin-top: 20px;
}</style>
    

<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                              <?php
    require_once "db.php";

 
    $destination = $_SESSION["destination"];
    $query = "SELECT * FROM core2_history WHERE destination = '$destination' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        foreach($query_run as $row)
        {

            if($row['status'] == 'pickup')
            {
                echo '<meta http-equiv="refresh" content="2">';
                echo "<br><center><strong> Waiting for Dropoff..."." </strong> <br> </center>";
                echo "<center><b>Fasten your seatbelt!</b> </center>";
                echo "<center> <b> 'May it be smooth and may you enjoy your trip' </b> </center>";
            } else {
                echo '<meta http-equiv="refresh" content="">';
                echo "<br><center> <b>"."Drop off: </b>"."Completed </center>";
                echo "<br><center> <b>"."THANK YOU FOR CHOOSING PHILTRANSURE!! </b>"."</center>";


            }

        }

    }
         
?>

                   <center><img src="img/cashs.gif"  style="margin-top: 20px; margin-bottom: 10px; height: 130px; width: 170px;">
                       </center>   
            </div>
           
                <div class="text-center">
                    <h1></h1>
                </div>
           <div class="new" style="text-align: justify-all;">


   <h4 class="table table-hover"><em><b>Destination:</b> <?php echo  $destination; ?>  </h4>   
   <h4 class="table table-hover"><em><b>Destination Address:</b> <?php echo  $destination_address; ?>  </h4>
   <h4 class="table table-hover"><b>Time Duration:</b> <?php echo $e . 'Min'; ?> </h4>
   <h4 class="table table-hover"><b>Distance:</b> <?php echo $c . 'km'; ?></em></h4>


   <hr style="border-top: 2px dashed black;color:transparent;"/>

   <h4 class="table table-hover"><em><b>Type: </b> <?php echo  $type; ?>  </h4>
   <h4 class="table table-hover"><em><b>Seating Capacity:</b> <?php echo  $seat_cap; ?>  </h4>
   <h4 class="table table-hover"><b>Base Price: </b> ₱<?php echo $base_price; ?> </h4>

    <hr style="border-top: 2px dashed black;color:transparent;"/>
   <h4 class="table table-hover"><b>Total:</b> ₱<?php  echo $total_cost; ?> </em></h4>


               </div>
                <center><a href="booking.php"><input type="submit" name="submit" id="submit" value="Complete" disabled style="margin-bottom: -20px; margin-top: 20px; background-color: #0d6efd; width: 100%; height: 7vh;"  /></a> </center>
        
            </div>
    
    </div>




<script>
function myFunction() {
 var status = "<?php echo $row['status']; ?>";
 if(status == "complete")
 {
    document.getElementById("submit").disabled = false;
     
 }  
}
</script> 
             
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>

<?php

if (isset($_POST['submit'])) {

    
    
}


?>