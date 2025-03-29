<?php
session_start();
include_once("mailer.php");
include 'db_connection.php';

if (isset($_SESSION['forgot_email'])) {
    $email = $_SESSION['forgot_email'];

    // Fetch OTP attempts and last resend time
    $query = "SELECT otp_attempts, last_resend FROM password_reset_requests WHERE email = '$email'";
    $result = $con->query($query);
    $row = mysqli_fetch_assoc($result);

    $attempts = $row['otp_attempts'];
    // $lastResend = strtotime($row['last_resend']);

    // // Check time difference (2 minutes = 120 seconds)
    // if (time() - $lastResend < 120) {
    //     echo "<script>alert('Please wait for 2 minutes before resending OTP.'); window.location.href='otp_form.php';</script>";
    //     exit();
    // }

    // Block further resends after 3 attempts
    if ($attempts >= 3) {
        $_SESSION['error'] = 'OTP resend limit reached. you can generate a new OTP after 24 hours.';
        header("Location: login.php");
        exit();
    }
    $email_time = date("Y-m-d H:i:s");
    $expiry_time = date("Y-m-d H:i:s", strtotime('+2 minutes'));
    // Generate a new OTP
    $new_otp = rand(100000, 999999);
    $updateQuery = "UPDATE password_reset_requests SET otp=$new_otp, otp_attempts=$attempts+1, last_resend=now(), created_at='$email_time', expires_at='$expiry_time' WHERE email='$email'";
    if ($con->query($updateQuery)) {
        $to = $email;
        $subject = "Reset password";
        $body = "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
            .container { max-width: 500px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center; }
            .header { background: #0B032D; color: #fff; padding: 15px; font-size: 20px; }
            .body { padding: 20px; font-size: 14px; color: #333; }
            .otp { display: inline-block; padding: 10px 20px; background: #0B032D; color: #fff; font-size: 18px; font-weight: bold; border-radius: 5px; letter-spacing: 3px; margin: 10px 0; }
            .footer { font-size: 12px; color: #666; padding: 10px; background: #f8f9fa; border-top: 1px solid #eee; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>Password Reset</div>
            <div class='body'>
                <p>Hi, You requested to reset your password. Use the OTP below to proceed:</p>
                <div class='otp'>$new_otp</div>
                <p>This OTP will expire in 10 minutes. If you did not request a password reset, please ignore this email.</p>
            </div>
            <div class='footer'>&copy; " . date('Y') . " Our Hotel. All rights reserved.</div>
        </div>
    </body>
    </html>
";
        if (sendEmail($to, $subject, $body, "")) {
            $_SESSION['success'] = "OTP for reset password is sent successfully";
            header("Location: verify_otp.php");
            exit();
        } else {
            $_SESSION['error'] = 'Error in sending OTP for reset password';
            header("Location: forget_password.php");
            exit();
        }
    }

    echo "<script>alert('New OTP sent.'); window.location.href='verify_otp.php';</script>";
    // Include header only if needed later
    include_once("header.php");
}
