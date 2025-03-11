<?php
session_start();
include_once("db_connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

    // Handle Profile Picture
    if (!empty($_FILES['profile_picture']['name'])) {
        $tmp_name = $_FILES['profile_picture']['tmp_name'];
        $profile_picture = uniqid() . "_" . $_FILES['profile_picture']['name'];
        $file_store = "assets/images/profile_picture/" . $profile_picture;
        move_uploaded_file($tmp_name, $file_store);
    } else {
        $profile_picture = "default.jpg"; // If no file selected, use default
    }

    // Generate Activation Code
    $activation_code = md5(uniqid(rand(), true));

    // Insert user into database with inactive status
    $query = "INSERT INTO users (fullname, email, password, confirm_password, mobile_no, address, role, status, profile_picture, activation_code)
              VALUES ('$fullname', '$email', '$password','$confirm_password','$mobile_no', '$address', 'guest', 'inactive', '$profile_picture', '$activation_code')";

    if (mysqli_query($con, $query)) {
        // Send Activation Email
        sendActivationEmail($email, $fullname, $activation_code);
        $_SESSION['message'] = '<div class="alert alert-success">Registration successful! Check your email for the activation link.</div>';
        header("Location: register.php"); // Redirect to show Bootstrap alert
        exit();
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger">Error in Registration. Please try again.</div>';
        header("Location: register.php");
        exit();
    }
}

// Function to send activation email
function sendActivationEmail($email, $fullname, $activation_code)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kkalariya174@rku.ac.in';
        $mail->Password = 'Krish@2006';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('kkalariya174@rku.ac.in', 'Your Hotel Name');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Activate Your Account';

        $activation_link = "http://localhost/hms/account_activate.php?code=$activation_code";
        $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .email-container {
                    max-width: 600px;
                    margin: 40px auto;
                    background: #ffffff;
                    border-radius: 8px;
                    overflow: hidden;
                    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                }
                .email-header {
                    background: #0B032D;
                    color: #ffffff;
                    text-align: center;
                    padding: 20px;
                    font-size: 24px;
                    font-weight: bold;
                }
                .email-body {
                    padding: 30px;
                    text-align: center;
                    color: #333333;
                }
                .email-body p {
                    font-size: 18px;
                    line-height: 1.6;
                    margin: 10px 0;
                }
                .activate-btn {
                    display: inline-block;
                    padding: 15px 25px;
                    margin-top: 20px;
                    background:rgb(6, 120, 40);
                    color: #FFFFFF !important;
                    font-size: 18px;
                    text-decoration: none;
                    border-radius: 5px;
                    font-weight: bold;
                    transition: background 0.3s;
                }
                a{
                    color: #FFFFFF;
                    text-decoration: none;
                }
                .activate-btn:hover {
                    background:rgb(0, 169, 56);
                }
                .footer {
                    text-align: center;
                    padding: 15px;
                    font-size: 14px;
                    color: #666666;
                    background: #f8f9fa;
                    border-top: 1px solid #eeeeee;
                }
                .footer a {
                    color: #0B032D;
                    text-decoration: none;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>
                    Welcome to Our Hotel
                </div>
                <div class='email-body'>
                    <p>Hi <strong>$fullname</strong>,</p>
                    <p>Thank you for signing up! Please activate your account by clicking the button below:</p>
                    <a href='$activation_link' class='activate-btn'>Activate My Account</a>
                    <p>If you didn't register, you can safely ignore this email.</p>
                </div>
                <div class='footer'>
                    &copy; " . date('Y') . " Our Hotel. All rights reserved. <br>
                    <a href='#'>Privacy Policy</a> | <a href='#'>Contact Support</a>
                </div>
            </div>
        </body>
        </html>
        ";


        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
