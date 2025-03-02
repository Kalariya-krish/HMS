<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $old_password = $_POST['old_password'];

    $query = "SELECT password FROM users WHERE id = '$user_id' AND email = '$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && $row['password'] == $old_password) {
        echo "valid";
    } else {
        echo "invalid";
    }
}
