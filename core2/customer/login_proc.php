<?php
include_once "assets/php/db.php";

if (isset($_POST['user']) && isset($_POST['password'])) {
    $user = htmlspecialchars($_POST['user']);
    $password = htmlspecialchars($_POST['password']);

    if ($user == "" && $password == "") {
        exit('empty');
    } else {
        $sql = 'select * from customer_accounts where customer_email=?';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            exit('fail');
        }
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $pwhashed = $row['customer_pw'];
            $pwcheck = password_verify($password, $pwhashed);
            // $pwcheck = $row['empl_password']; //For testing, Unhashed password
            mysqli_stmt_close($stmt);

            if ($pwcheck === false /*$pwcheck != $password/*For testing*/) {
                exit('incorrect');
            } else {
                session_start();
                $_SESSION['customer_email'] = $row['customer_email'];

                // exit($_SESSION['customer_email']);
                exit("logmein");
            }
        } else {
            exit('incorrect');
        }
    }
}
