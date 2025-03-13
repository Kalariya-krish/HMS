<?php
include_once('db_connection.php');
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $q = "SELECT * FROM users WHERE email='$email'";
    $result = $con->query($q);
    if ($result->num_rows > 0) {
        echo 'true'; // email exists
    } else {
        echo 'false'; // email does not exist
    }
    exit; // Ensure no other content is sent
}
