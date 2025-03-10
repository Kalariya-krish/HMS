<?php
include_once('db_connection.php');
if (!isset($_GET['token'])) {
    die("Invalid request!");
}

$reset_code = $_GET['token'];

$query = "SELECT user_id FROM password_reset_tokens WHERE token = '$reset_code' AND expires_at > NOW()";
$result = mysqli_query($con, $query);

// Add this after your query to debug
if (!$result) {
    die("Database error: " . mysqli_error($con));
}
echo "Token: " . $reset_code . "<br>";
echo "Rows found: " . mysqli_num_rows($result) . "<br>";

if (!$result || mysqli_num_rows($result) == 0) {
    die("Invalid or expired reset link.");
}

$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];

if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE users SET password='$hashed_password' WHERE id='$user_id'";
        mysqli_query($con, $updateQuery);

        // Delete the used token to prevent reuse
        $deleteQuery = "DELETE FROM password_reset_tokens WHERE token='$reset_code'";
        mysqli_query($con, $deleteQuery);

        $_SESSION['success'] = "Password reset successful. You can now <a href='login.php'>login</a>.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <?php include_once('header.php'); ?>

    <section><br><br>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-6">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                                        unset($_SESSION['error']); ?></div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success"><?php echo $_SESSION['success'];
                                                            unset($_SESSION['success']); ?></div>
                    <?php endif; ?>

                    <div class="card">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Reset Your Password</h2>

                            <form id="resetPasswordForm" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="new_password"><i class="fa fa-lock"></i> New Password</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="confirm_password"><i class="fa fa-lock"></i> Confirm Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-md" style="background-color: #0B032D;" name="reset_password">Reset Password</button>
                                </div>

                                <p class="text-center text-muted mt-4">Remember your password?
                                    <a href="login.php" class="fw-bold text-body"><u>Login here</u></a>
                                </p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>

    <?php include('footer.php'); ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#resetPasswordForm").submit(function(e) {
                e.preventDefault();
                if ($('#resetPasswordForm').valid()) {
                    this.submit();
                }
            });

            $('#resetPasswordForm').validate({
                rules: {
                    new_password: {
                        required: true,
                        minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#new_password"
                    }
                },
                messages: {
                    new_password: {
                        required: "New password is required",
                        minlength: "Password must be at least 8 characters"
                    },
                    confirm_password: {
                        required: "Please confirm your password",
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