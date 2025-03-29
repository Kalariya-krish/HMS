<?php
session_start();
include_once('db_connection.php');

if (isset($_POST['reset_password'])) {
    if (isset($_SESSION['forgot_email'])) {
        $email = $_SESSION['forgot_email'];
        $password = $_POST['new_password'];

        // Update the user's password in the users table (assuming the table is named 'users')
        $update_query = "UPDATE users SET password = '$password',confirm_password='$password' WHERE email = '$email'";
        if (mysqli_query($con, $update_query)) {
            // Delete the token from the password_token table
            $delete_query = "DELETE FROM password_reset_requests WHERE email = '$email'";
            mysqli_query($con, $delete_query);
            unset($_SESSION['forgot_email']);
            $_SESSION['success'] = 'Password has been reset successfully.';
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = 'Error in resetting Password.';
            header("Location: forget_password.php");
            exit();
        }
    } else {
        $_SESSION['error'] = 'No email found for resetting password.';
        header("Location: forget_password.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <section class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h2 class="text-uppercase text-center mb-4">Reset Password</h2>
                <p class="text-muted text-center mb-4">Please enter your new password below.</p>

                <form action="reset_password.php" method="post">
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="new_password">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Confirm Password</label>
                        <input type="test" name="confirm_password" class="form-control" id="confirm_password">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="reset_password" class="btn btn-success btn-md" style="background-color: #0B032D;">Update Password</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="login.php" class="text-decoration-none">Back to Login</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>