<?php
include_once("db_connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $mobile_no = $_POST['mobileno'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $tmp_name = $_FILES['profile_picture']['tmp_name'];
    $profile_picture = uniqid() . $_FILES['profile_picture']['name'];
    $file_store = "assets/images/profile_picture/" . $profile_picture;

    // Insert into database
    $q = "INSERT INTO users (fullname, email, mobile_no, password, confirm_password, address, profile_picture) 
          VALUES ('$fullname', '$email', '$mobile_no', '$password', '$confirm_password', '$address', '$profile_picture')";

    if (mysqli_query($con, $q)) {
        move_uploaded_file($tmp_name, $file_store); // Move file before redirection

        // Email setup
        $link = "http://localhost/hms/account_activation.php?email=$email";
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = "kkalariya174@rku.ac.in";
        $mail->Password = "Krish@2006";  // Use App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('kkalariya174@rku.ac.in', 'Astoria Hotel Booking');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Account Activation Link";
        $mail->Body = "Your account has been created successfully. <br> Click the link to activate: <a href='$link'>$link</a>";

        if ($mail->send()) {
            $_SESSION['reg_msg'] = "Account created successfully. Check your email for activation link.";
        } else {
            $_SESSION['reg_msg_err'] = "Error sending email: " . $mail->ErrorInfo;
        }

        echo "<script>
                alert('Registration successful! Check your email for activation link.');
                window.location = 'login.php';
              </script>";
    } else {
        echo "<script>alert('Error in Registration');</script>";
    }
}
