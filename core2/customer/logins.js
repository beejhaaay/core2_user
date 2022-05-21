$(document).ready(function () {
    $("#forgotpw").click(function (e) {
        e.preventDefault();

        swal.fire({
            icon: 'info',
            title: 'Feature not ready.',
            showConfirmButton: true
        });
    });

    $("#customer_logform").submit(function (event) {
        event.preventDefault();

        var user = $("#user").val();
        var password = $("#password").val();

        if (user == "" || password == "") {
            swal.fire({
                icon: 'error',
                title: 'Please fill up all fields.',
                showConfirmButton: true
            });
        } else {
            $.ajax({
                url: "login_proc.php",
                method: "POST",
                data: {
                    user: user,
                    password: password,
                },
                success: function (response) {

                    swal.fire({
                        icon: 'info',
                        title: 'Loading...',
                        showConfirmButton: false,
                        timer: 800
                    });

                    switch (response) {
                        case "error":
                            swal.fire({
                                icon: 'error',
                                title: 'Something has gone wrong!',
                                showConfirmButton: false,
                                timer: 800
                            });
                            break;
                        case "incorrect":
                            swal.fire({
                                icon: 'error',
                                title: 'Incorrect Email Address or Password!',
                                showConfirmButton: true
                            });
                            break;
                        case "empty":
                            swal.fire({
                                icon: 'error',
                                title: 'Email Address or Password cannot be empty!',
                                showConfirmButton: true
                            });
                            break;
                        case "logmein":
                            swal.fire({
                                icon: 'success',
                                title: "Logging in...",
                                showConfirmButton: false
                            });
                            setTimeout(function () {
                                location.href = "../user/booking.php";
                            }, 800);
                            break;
                        default:
                            swal.fire({
                                icon: 'info',
                                title: response,
                                showConfirmButton: false,
                                timer: 700
                            });
                            console.log(response);
                            setTimeout(function () {
                                $(".customer_login_input").val('');
                            }, 800);
                    }
                },
            });
        }
    });

});