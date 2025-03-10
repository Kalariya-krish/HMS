<?php
session_start();
include_once('db_connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Check if email exists
    $query = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['id'];

        // Generate secure token
        $token = bin2hex(random_bytes(20));
        $expires_at = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Delete old tokens
        mysqli_query($con, "DELETE FROM password_reset_tokens WHERE user_id = '$user_id'");

        // Store the new token
        $insertQuery = "INSERT INTO password_reset_tokens (user_id, token, expires_at) 
                        VALUES ('$user_id', '$token', '$expires_at')";
        mysqli_query($con, $insertQuery);

        // Email sending
        $reset_link = "http://localhost/hms/reset_password.php?token=$token";
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kkalariya174@rku.ac.in';  // Use your email
            $mail->Password = 'Krish@2006';    // Use App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('kkalariya174@rku.ac.in', 'Astoria Hotel');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Reset Your Password";
            $mail->Body = "Click <a href='$reset_link'>here</a> to reset your password.";

            $mail->send();
            $_SESSION['success'] = "Password reset link sent to your email.";
        } catch (Exception $e) {
            $_SESSION['error'] = "Email could not be sent. Error: " . $mail->ErrorInfo;
        }
    } else {
        $_SESSION['error'] = "No account found with this email.";
    }

    header("Location: forget_password.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
                                    <input type="email" id="email" name="email" class="form-control" required />
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