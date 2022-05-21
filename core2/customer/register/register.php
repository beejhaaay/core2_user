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
    <title>Register</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/auth.css" rel="stylesheet">

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
                        <!-- <img class="brand" src="assets/img/bootstraper-logo.png" alt="bootstraper logo"> -->
                        <h1>Philtransure</h1>
                    </div>
                    <h6 class="mb-4 text-muted">Create new account</h6>
                    <form id="customer_reg_form" autocomplete="off">
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email adress</label>
                            <input type="email" id="email-addr" class="form-control customer_reg_form_imput" placeholder="Enter Email" required>
                            <div id="email-invalid-feedback" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label">First Name</label>
                            <input type="text" id="reg-fname" class="form-control customer_reg_form_imput" placeholder="Enter First Name" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label">Last Name</label>
                            <input type="text" id="reg-lname" class="form-control customer_reg_form_imput" placeholder="Enter Last Name" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="reg-pw" class="form-control customer_reg_form_imput" placeholder="Password" required>
                            <div id="pw-invalid-feedback" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="password" id="reg-conf-pw" class="form-control customer_reg_form_imput" placeholder="Confirm password" required>
                            <div id="pw-conf-invalid-feedback" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 text-start">
                            <div class="form-check">
                                <input id="customer_reg_tos_chbox" class="form-check-input" name="confirm" type="checkbox" value="" id="check1" required>
                                <label class="form-check-label" for="check1">
                                    I agree to the <a href="#" tabindex="-1">terms and policy</a>.
                                </label>
                            </div>
                        </div>
                        <button id="customer_reg_btn" class="btn btn-primary shadow-2 mb-4" disabled>Register</button>
                    </form>
                    <p class="mb-0 text-muted">Allready have an account? <a href="../index.php">Log in</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="registers.js"></script>
</body>

</html>