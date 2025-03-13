<?php
include_once('../db_connection.php');
if (isset($_GET['email']) && isset($_GET['current_password'])) {
    $email = $_GET['email'];
    $current_password = $_GET['current_password'];
    $q = "SELECT password FROM users WHERE email='$email' AND password = '$current_password'";
    $result = $con->query($q);
    if ($result->num_rows > 0) {
        echo 'true'; // Password is correct
    } else {
        echo 'false'; // Password is incorrect
    }
}
