<?php
include_once('../db_connection.php');
if (isset($_GET['room_no'])) {
    $room_no = $_GET['room_no'];
    $q = "SELECT * FROM rooms WHERE room_no='$room_no'";
    $result = $con->query($q);
    if ($result->num_rows > 0) {
        echo 'true'; // room exists
    } else {
        echo 'false'; // room does not exist
    }
    exit; // Ensure no other content is sent
}
