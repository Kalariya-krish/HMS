<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $old_password = $_POST['old_password'];

    // Get stored hashed password from the database
    $query = "SELECT password FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($old_password, $row['password'])) {
        echo "valid"; // Password is correct
    } else {
        echo "invalid"; // Password is incorrect
    }
}
