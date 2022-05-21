<?php
include_once "../assets/php/db.php";

if (isset($_POST['reg_email_addr']) && isset($_POST['reg_fname']) && isset($_POST['reg_lname']) && isset($_POST['reg_pw'])) {
    # code...
    if ($_POST['reg_email_addr'] == "" && $_POST['reg_fname'] == "" && $_POST['reg_lname'] == "" && $_POST['reg_pw'] == "") {
        # code...
        exit("empty");
    } else {
        # code...
        $hashed_pw = password_hash($_POST['reg_pw'], PASSWORD_DEFAULT);

        $query_customer_email = "SELECT * FROM customer_accounts WHERE customer_email=?;";
        $stmnt_customer_email = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmnt_customer_email, $query_customer_email)) {
            exit("fail");
        }

        mysqli_stmt_bind_param($stmnt_customer_email, "s", $_POST['reg_email_addr']);
        mysqli_stmt_execute($stmnt_customer_email);

        $results = mysqli_stmt_get_result($stmnt_customer_email);
        if ($count = mysqli_num_rows($results) > 0) {
            mysqli_stmt_close($stmnt_customer_email);
            exit('exists');
        } else {
            $query_create_acc = "INSERT INTO customer_accounts (customer_email, customer_fname, customer_lname, customer_pw) VALUES (?, ?, ?, ?);";
            $stmnt_query_create_acc = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmnt_query_create_acc, $query_create_acc)) {
                exit('fail');
            }

            mysqli_stmt_bind_param($stmnt_query_create_acc, "ssss", $_POST['reg_email_addr'], $_POST['reg_fname'], $_POST['reg_lname'], $hashed_pw);

            mysqli_stmt_execute($stmnt_query_create_acc);
            mysqli_stmt_close($stmnt_query_create_acc);
            mysqli_stmt_close($stmnt_customer_email);
            exit('acc_created');
        }
    }
}
