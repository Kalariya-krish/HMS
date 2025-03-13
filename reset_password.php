<?php
session_start();
include_once('db_connection.php');

if (!isset($_SESSION['verified'])) {
    $_SESSION['error'] = "Unauthorized access!";
    header("Location: login.php"); // Redirect if not verified
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $newPassword = $_POST['password'];

    // Update password in users table
    $query1 = "UPDATE users SET password = '$newPassword', confirm_password = '$newPassword' WHERE email = '$email'";
    mysqli_query($con, $query1);

    // Remove OTP entry from password_reset_requests
    $query2 = "DELETE FROM password_reset_requests WHERE email = '$email'";
    mysqli_query($con, $query2);

    session_destroy();
    header("Location: login.php");
    exit;
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
                        <input type="password" name="password" class="form-control" id="newPassword" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-md" style="background-color: #0B032D;">Update Password</button>
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