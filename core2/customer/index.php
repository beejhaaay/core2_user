<?php
session_start();
if (isset($_SESSION['customer_email'])) {
    header('Location: ../core2/user/booking.php');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/jpg" href="assets/img/philtransure_icon.png" />    

    <title>Login Page</title>
    <link href="../assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/auth.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.5/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <img style="height: 50%; width: 50%;" class="brand" src="assets/img/philtransure_logo_icon.png" alt="bootstraper logo">
                    </div>
                    <h6 class="mb-4 text-muted">Login to your account</h6>
                    <form id="customer_logform" autocomplete="off">
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="user" class="form-control customer_login_input" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control customer_login_input" placeholder="Password" required>
                        </div>
                        <!-- <div class="mb-3 text-start">
                            <div class="form-check">
                                <input class="form-check-input" name="remember" type="checkbox" value="" id="check1">
                                <label class="form-check-label" for="check1">
                                    Remember me on this device
                                </label>
                            </div>
                        </div> -->
                        <button class="btn btn-primary shadow-2 mb-4">Login</button>
                    </form>
                    <p class="mb-2 text-muted"><a id="forgotpw" href="">Forgot password?</a></p>
                    <p class="mb-0 text-muted">Don't have account yet? <a href="register/register.php">Signup</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="logins.js"></script>
</body>

</html>
