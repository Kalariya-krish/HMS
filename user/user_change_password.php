<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'];

    $update_query = "UPDATE users SET password = '$new_password', confirm_password = '$new_password' WHERE email = '$email'";

    if ($con->query($update_query)) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Password updated successfully!'
        ];
    } else {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Failed to update password: ' . $con->error
        ];
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
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
                            <!-- Display alert if set -->
                            <?php if (isset($_SESSION['alert'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['alert']['type']; ?> alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['alert']['message']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                                // Clear the alert after displaying
                                unset($_SESSION['alert']);
                            endif;
                            ?>

                            <h2 class="text-uppercase text-center mb-5">Change Password</h2>

                            <form id="changepasswordform" name="changepasswordform" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label"><i class="fa fa-lock"></i> Current Password</label>
                                    <input type="text" id="current_password" name="current_password" class="form-control" required />
                                    <div class="error text-danger"></div> <!-- Ensure error div exists -->
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label"><i class="fa fa-lock"></i> New Password</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label"><i class="fa fa-lock"></i> Confirm New Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-md" id="submit_btn" style="background-color: #0B032D;">Change Password</button>
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
            // Custom validator for checking current password via AJAX
            $.validator.addMethod("checkCurrentPassword", function(value, element) {
                var valid = false;
                $.ajax({
                    type: 'GET',
                    url: 'user_check_oldpassword.php',
                    data: {
                        email: "<?php echo $_SESSION['email']; ?>",
                        current_password: value
                    },
                    async: false, // Need synchronous for validator
                    success: function(response) {
                        valid = (response == 'true');
                    }
                });
                return valid;
            }, "Incorrect current password.");

            // Form validation
            $('#changepasswordform').validate({
                rules: {
                    current_password: {
                        required: true,
                        minlength: 8,
                        maxlength: 20,
                        checkCurrentPassword: true
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
                    current_password: {
                        required: "Current password is required",
                        minlength: "Password must be at least 8 characters",
                        maxlength: "Password cannot exceed 20 characters",
                        checkCurrentPassword: "Incorrect current password."
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
                    // If this is the current_password field, put error in the dedicated .error div
                    if (element.attr('id') === 'current_password') {
                        error.appendTo(element.siblings('.error'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });

            // Remove the standalone blur event since we're handling it with the validator
            // $('#current_password').off('blur');
        });
    </script>
</body>

</html>