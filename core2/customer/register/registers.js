function validate_email() {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/.test($("#email-addr").val())) {
        if ($("#email-addr").hasClass("is-invalid")) {
            $("#email-addr").removeClass("is-invalid");
            $("#email-invalid-feedback").text("");
        }
        $("#email-addr").addClass("is-valid");
    } else {
        $("#email-addr").addClass("is-invalid");
        $("#email-invalid-feedback").text("Invalid Email Address.");
    }
}

function validate_pw() {
    if (/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test($("#reg-pw").val())) {
        if ($("#reg-pw").hasClass("is-invalid")) {
            $("#reg-pw").removeClass("is-invalid");
            $("#pw-invalid-feedback").text("");
        } else {
            $("#reg-pw").addClass("is-valid");
        }
    } else {
        $("#reg-pw").addClass("is-invalid");
        $("#pw-invalid-feedback").text("Password must be at least 8 characters long and contain 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special symbol.");
    }
}

function conf_pw() {
    if ($("#reg-pw").val() == $("#reg-conf-pw").val()) {
        if ($("#reg-conf-pw").hasClass("is-invalid")) {
            $("#reg-conf-pw").removeClass("is-invalid")
        }
        $("#reg-conf-pw").addClass("is-valid");
        $("#pw-conf-invalid-feedback").text("");
    } else {
        $("#reg-conf-pw").addClass("is-invalid");
        $("#pw-conf-invalid-feedback").text("Passwords do not match.");
    }
}

function disable_enable_reg_btn() {
    if ($("#email-addr").val() != "" || $("#reg-fname").val() != "" || $("#reg-lname").val() != "" || $("#reg-pw").val() != "") {
        if ($("#email-addr").hasClass("is-valid") && $("#reg-pw").hasClass("is-valid") && $("#reg-pw").val() == $("#reg-conf-pw").val() && $("#reg-fname").val() != "" && $("#reg-lname").val() != "" && $("#customer_reg_tos_chbox").is(":checked") == true) {
            $("#customer_reg_btn").removeAttr("disabled");
        } else {
            if ($("#customer_reg_btn").prop("disabled") !== "undefined") {
                $("#customer_reg_btn").prop("disabled", true);
            }
        }
    }
}

function clear_form_invalid() {
    $(".customer_reg_form_imput").val("");
    $("#customer_reg_btn").prop("disabled", true);

    if ($(".customer_reg_form_imput").hasClass("is-invalid")) {
        $(".customer_reg_form_imput").removeClass("is-invalid");
        if ($("#pw-invalid-feedback").text() != "") {
            $("#pw-invalid-feedback").text("");
        }

        if ($("#pw-conf-invalid-feedback").text() != "") {
            $("#pw-conf-invalid-feedback").text("");
        }
    }

    if ($(".customer_reg_form_imput").hasClass("is-valid")) {
        $(".customer_reg_form_imput").removeClass("is-valid");
    }

    if ($("#customer_reg_tos_chbox").is(":checked") == true) {
        $("#customer_reg_tos_chbox").prop('checked', false);
    }

    swal.fire({
        icon: 'error',
        title: 'Please check required fields.',
        showConfirmButton: true
    });
}

$(document).ready(function () {
    $(".customer_reg_form_imput").focus(function () {
        disable_enable_reg_btn();
    });

    $(".customer_reg_form_imput").blur(function () {
        disable_enable_reg_btn();
    });

    $("#email-addr").keyup(function () {
        if ($("#email-addr").val() != "" && $("#email-addr").val().length > 4) {
            setTimeout(function () {
                validate_email();
            }, 200);
        } if ($("#email-addr").val() == "") {
            if ($("#email-addr").hasClass("is-invalid")) {
                $("#email-addr").removeClass("is-invalid");
                $("#email-invalid-feedback").text("");
            } else if ($("#email-addr").hasClass("is-valid")) {
                $("#email-addr").removeClass("is-valid");
            }
        }
    });

    $("#reg-pw").keyup(function () {
        if ($("#reg-pw").val() != "") {
            setTimeout(function () {
                validate_pw();
                if ($("#reg-conf-pw").val() != "") {
                    conf_pw();
                }
                disable_enable_reg_btn();
            }, 100);
        } else {
            if ($("#reg-pw").hasClass("is-invalid")) {
                $("#reg-pw").removeClass("is-invalid");
                $("#pw-invalid-feedback").text("");
            } else if ($("#reg-pw").hasClass("is-valid")) {
                $("#reg-pw").addClass("is-valid");
            }
        }
    });

    $("#reg-conf-pw").keyup(function () {
        if ($("#reg-conf-pw").val() != "") {
            setTimeout(function () {
                conf_pw();
                if ($("#reg-pw").val() != "") {
                    validate_pw();
                }
                disable_enable_reg_btn();
            }, 100)
        } else {
            if ($("#reg-conf-pw").hasClass("is-invalid")) {
                $("#reg-conf-pw").removeClass("is-invalid")
            } else if ($("#reg-conf-pw").hasClass("is-valid")) {
                $("#reg-conf-pw").addClass("is-valid");
                $("#pw-conf-invalid-feedback").text("");
            }
        }
    });

    $("#customer_reg_tos_chbox").click(function () {
        disable_enable_reg_btn();
    });

    $("#customer_reg_form").submit(function (event) {
        event.preventDefault();

        var reg_email_addr = $("#email-addr").val();
        var reg_fname = $("#reg-fname").val();
        var reg_lname = $("#reg-lname").val();
        var reg_pw = $("#reg-pw").val();

        if (reg_email_addr == "" || reg_fname == "" || reg_lname == "" || reg_pw == "") {
            swal.fire({
                icon: 'error',
                title: 'Please fill up all fields.',
                showConfirmButton: true
            });
        } else {
            if ($("#email-addr").hasClass("is-valid") && $("#reg-pw").hasClass("is-valid") && $("#reg-pw").val() == $("#reg-conf-pw").val() && $("#reg-fname").val() != "" && $("#reg-lname").val() != "" && $("#customer_reg_tos_chbox").is(":checked") == true) {
                if ($("#customer_reg_btn").prop("disabled") !== "undefined") {
                    $("#customer_reg_btn").prop("disabled", true);
                    $.ajax({
                        url: "reg_proc.php",
                        method: "POST",
                        data: {
                            reg_email_addr: reg_email_addr,
                            reg_fname: reg_fname,
                            reg_lname: reg_lname,
                            reg_pw: reg_pw,
                        },
                        success: function (response) {

                            swal.fire({
                                icon: 'info',
                                title: 'Loading...',
                                showConfirmButton: false,
                                timer: 800
                            });

                            switch (response) {
                                case "fail":
                                    clear_form_invalid();
                                    swal.fire({
                                        icon: 'error',
                                        title: 'Something has gone wrong!',
                                        showConfirmButton: true
                                    });
                                    break;
                                case "exists":
                                    $("#email-addr").val("");
                                    if ($("#customer_reg_tos_chbox").is(":checked") == true) {
                                        $("#customer_reg_tos_chbox").prop('checked', false);
                                    }
                                    if ($("#email-addr").hasClass("is-valid")) {
                                        $("#email-addr").removeClass("is-valid");
                                    }
                                    swal.fire({
                                        icon: 'error',
                                        title: 'Email already exists!',
                                        showConfirmButton: true
                                    });
                                    break;
                                case "empty":
                                    clear_form_invalid();
                                    swal.fire({
                                        icon: 'error',
                                        title: 'Fill up all fields!',
                                        showConfirmButton: true
                                    });
                                    break;
                                case "acc_created":
                                    swal.fire({
                                        icon: 'success',
                                        title: "Account Created!",
                                        showConfirmButton: false
                                    });
                                    setTimeout(function () {
                                        $("#customer_reg_btn").prop("disabled", true);
                                        // console.log(response);
                                        location.href = "../index.php";
                                    }, 800);
                                    break;
                                default:
                                    swal.fire({
                                        icon: 'info',
                                        showConfirmButton: true
                                    });
                                    console.log(response);
                            }
                        },
                    });
                } else {
                    clear_form_invalid();
                }
            } else {
                clear_form_invalid();
            }
        }
    });
});