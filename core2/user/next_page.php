
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
     <link rel="shortcut icon" type="image/jpg" href="../assets/img/philtransure_icon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <!-- navbar navigation component -->
    <nav class="navbar navbar-expand-lg navbar-white bg-white">

    </nav>
    <!-- end of navbar navigation -->
    <div class="wrapper">
        <div id="body" class="active">

            <div class="container-fluid">
                <div class="container-fluid">
                 
                    <h2 class="mt-5 mb-3">
                    <button onclick="history.back()" class="btn btn-success"style=" margin-top: 10px; margin-bottom: 10px;  background-color: white; color: #0d6efd; border: none; "><h2>Back</h2></button> / Destination Details</h2>
                    
                    <div class="page-title">

                       <style>
                        th{

                           font-size: 20px;

                        }

                       </style>
                        <?php

                        session_start();
                        $a = $_GET['distance'];
                        $b = 13;
                        $c =  (floor($a));
                        $d = $_GET['duration'];
                        $e = (floor($d));
                        $total = (ceil($a*$b));
                        $totals = $total;


                        
                        $_SESSION["destination"] =  $_GET['destination'];
                        $_SESSION["destination_address"] =  $_GET['destination_address'];
                        $_SESSION["c"] = $c;
                        $_SESSION["e"] = $e;
                        $_SESSION["totals"] = $totals;
                        $_SESSION["position"] = $_GET['position'];

                echo '<table class="table table-bordered table-striped">';
                    echo "<thead>";
                                        echo "<th>Destination</th>";
                                        echo "<th>Destination Address</th>";
                                        echo "<th>Distance in kilometer</th>";
                                        echo "<th>Time Duration</th>";
                                       
                                        
                    echo "</thead>";

                    echo "<tbody style>";
                        echo '<td>' . $_GET['destination'] . '</h1> </td>';
                        
                        echo '<td>' . $_GET['destination_address'] . '</h1> </td>' ;
                        echo '<td>' . $c . ' km'.'</h1> </td>';
                        echo '<td>' . $e . ' min' . '</h1> </td>' ;
                       
                        
                      
                    echo "</tbody>";

                        echo "</table>";
                        ?>

                     <!DOCTYPE html>
                     <html>
                     <head>
                         <meta charset="utf-8">
                         <meta name="viewport" content="width=device-width, initial-scale=1">
                         <title></title>
                         <style type="text/css">
                            th, td{
                                text-align: center;

                            }
                         </style>
                     </head>

                     <body>
                        <h2 class="mt-5 mb-3"> Choose Vehicle</h2>
                            <?php
                    // Include config file
                    require_once "db.php";

                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM core2_add ";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table style="td{ content:center; }"; class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                     
                                        echo "<th>Type</th>";
                                        
                                        echo "<th>Seating Capacity</th>";
                                        echo "<th>Base Price</th>";
                                        echo "<th style='color: #0d6efd;'>Proceed </th>";
                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                  
                                        echo "<td>" . $row['type'] . "</td>";
                                       
                                              
                                        echo "<td>" . $row['seat_cap'] . "</td>";

                                    echo "<td>" . '₱ '. $row['base_price']. "</td>";

                                        $_SESSION["base_price"] = $row['base_price'];



                                        echo "<td>";
                                       echo '<center>
                                                <a href="confirmation.php?
                                                id='. $row['id'] .' &
                                                " 
                                                <button class="btn btn-primary" style="
                                                  font-family: sans-serif;
                                                  font-size: 16px;
                                                  background-color: #0d6efd; 
                                                  border-color: blue;
                                                  color: white; 
                                                  display: block;
                                                  height: 5vh;
                                                  border-radius: 4px;
                                                  width: 60%;">Choose</button>
                                                </center>'; 
                                            
                                        echo "</td>";

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
                        
                     </body>

                     </html>



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