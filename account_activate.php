<?php
include_once("db_connection.php");

if (isset($_GET['code'])) {
    $activation_code = $_GET['code'];

    // Check if the activation code exists
    $query = "SELECT * FROM users WHERE activation_code = '$activation_code' AND status = 'inactive'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Activate account
        $update_query = "UPDATE users SET status = 'active', activation_code = NULL WHERE activation_code = '$activation_code'";
        if (mysqli_query($con, $update_query)) {
            echo "<script>alert('Account activated successfully! You can now log in.'); window.location = 'login.php';</script>";
        } else {
            echo "<script>alert('Account activation failed. Please try again later.');</script>";
        }
    } else {
        echo "<script>alert('Invalid or expired activation link.'); window.location = 'login.php';</script>";
    }
} else {
    echo "<script>alert('No activation code provided.'); window.location = 'login.php';</script>";
}
