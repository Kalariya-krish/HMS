<?php
session_start();
include_once('db_connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Check if email exists in users table
    $result = mysqli_query($con, "SELECT id FROM users WHERE email = '$email'");

    if (mysqli_num_rows($result) > 0) {
        $otp = rand(100000, 999999); // Generate 6-digit OTP
        $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        // Insert OTP into password_reset_requests table
        mysqli_query($con, "INSERT INTO password_reset_requests (email, otp, expires_at) VALUES ('$email', '$otp', '$expiry')");

        // Create PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Enable debugging (optional)
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kkalariya174@rku.ac.in';
            $mail->Password = 'Krish@2006';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('kkalariya174@rku.ac.in', 'Kris Kalariya');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset OTP';

            // Email body with styling
            $mail->Body = "
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
                <div class='otp'>$otp</div>
                <p>This OTP will expire in 10 minutes. If you did not request a password reset, please ignore this email.</p>
            </div>
            <div class='footer'>&copy; " . date('Y') . " Our Hotel. All rights reserved.</div>
        </div>
    </body>
    </html>
";
            $mail->send();
            $_SESSION['success'] = "Password reset OTP sent successfully. Please check your email.";
        } catch (Exception $e) {
            $_SESSION['error'] = "Email sending failed: " . $mail->ErrorInfo;
        }

        $_SESSION['email'] = $email;
        header("Location: verify_otp.php");
        exit;
    } else {
        $_SESSION['error'] = "Email not found!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
</head>

<body>
    <?php include_once('header.php'); ?>

    <section><br><br>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Forgot Password</h2>
                            <p class="text-muted text-center mb-4">Enter your email address and we'll send you instructions to reset your password.</p>

                            <!-- Display session messages -->
                            <?php
                            if (isset($_SESSION['success'])) {
                                echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
                                unset($_SESSION['success']); // Clear session message
                            }
                            if (isset($_SESSION['error'])) {
                                echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                                unset($_SESSION['error']); // Clear session message
                            }
                            ?>

                            <form id="forgotPasswordForm" name="forgotPasswordForm" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email"><i class="fa fa-envelope"></i> Enter your registered email : </label>
                                    <input type="email" id="email" name="email" class="form-control" />
                                    <div class="error" id="emailError"></div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-md" style="background-color: #0B032D;">Reset Password</button>
                                </div>

                                <p class="text-center text-muted mt-4">
                                    Remember your password?
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

    <!-- JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#forgotPasswordForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: "Email is required",
                        email: "Enter a valid email"
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