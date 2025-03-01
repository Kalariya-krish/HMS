<?php
session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI']; // Save the requested page
    $_SESSION['error'] = "You must log in first!";
    header("Location: ../login.php");
    exit();
}
