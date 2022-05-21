  <?php
    include 'db.php';
       
session_start();
  if (isset($_POST["save"])) {

    $type =  $_SESSION["type"];
    $seat_cap = $_SESSION["seat_cap"];
    $base_price = $_SESSION["base_price"];

    $destination = $_SESSION["destination"];
    $destination_address = $_SESSION["destination_address"];
    $c = $_SESSION["c"];
    $e = $_SESSION["e"];
    $total_cost = $_SESSION["total_cost"];
    date_default_timezone_set("Asia/Manila"); 
    $time2 = date('Y-m-d H:i:s');
    $user  = $_SESSION['customer_email'];
    $starting_point  = $_SESSION['position'];
 



    $status = 'Pending';
    $query = "INSERT INTO core2_history (c_user, starting_point, type, seat_cap, base_price , destination, address, distance, time, total_cost, status, completed_time) values 
    ('$user', ' $starting_point', '$type', '$seat_cap', '$base_price', '$destination', '$destination_address', '$c', '$e', '$total_cost' ,'$status', '$time2')";
    $run = mysqli_query($conn, $query);

    if($run)
    {
        echo "<script>alert('Success');window.location.href='cash.php';</script>";
    } else {
        echo "<script>alert('Error');window.location.href='confirmation.php';</script>";
    }
  }
                        

?>
