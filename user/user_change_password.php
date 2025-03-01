<?php
include_once('../db_connection.php');
include_once('../auth_check.php');
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Change Password">
    <meta name="keywords" content="password, update, change">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
</head>

<body>
    <?php include_once('user_header.php'); ?>

    <section><br><br>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Change Password</h2>

                            <form id="changepasswordform" name="changepasswordform" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label"><i class="fa fa-lock"></i> Current Password</label>
                                    <input type="password" id="current_password" name="old_password" class="form-control" required />
                                    <div id="password_error" class="text-danger"></div> <!-- Error Message -->
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label"><i class="fa fa-lock"></i> New Password</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label"><i class="fa fa-lock"></i> Confirm New Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-md" id="submit_btn" style="background-color: #0B032D;" disabled>Change Password</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>

    <?php include('user_footer.php'); ?>

    <!-- JS -->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            // Validate old password using AJAX when user leaves the input field
            $("#current_password").on("blur", function() {
                let oldPassword = $(this).val();

                if (oldPassword.length >= 8) {
                    $.ajax({
                        url: "user_validate_oldpassword.php",
                        type: "POST",
                        data: {
                            old_password: oldPassword
                        },
                        success: function(response) {
                            if (response.trim() == "valid") {
                                $("#password_error").text("Password is correct").removeClass("text-danger").addClass("text-success");
                                $("#submit_btn").prop("disabled", false);
                            } else {
                                $("#password_error").text("Incorrect current password").removeClass("text-success").addClass("text-danger");
                                $("#submit_btn").prop("disabled", true);
                            }
                        },
                        error: function() {
                            $("#password_error").text("Server error").addClass("text-danger");
                        }
                    });
                }
            });

            // Form validation
            $('#changepasswordform').validate({
                rules: {
                    old_password: {
                        required: true,
                        minlength: 8,
                        maxlength: 20
                    },
                    new_password: {
                        required: true,
                        minlength: 8,
                        maxlength: 20
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#new_password"
                    }
                },
                messages: {
                    old_password: {
                        required: "Current password is required",
                        minlength: "Password must be at least 8 characters",
                        maxlength: "Password cannot exceed 20 characters"
                    },
                    new_password: {
                        required: "New password is required",
                        minlength: "Password must be at least 8 characters",
                        maxlength: "Password cannot exceed 20 characters"
                    },
                    confirm_password: {
                        required: "Confirm password is required",
                        equalTo: "Passwords do not match"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>