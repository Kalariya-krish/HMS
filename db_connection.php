<?php
$con = mysqli_connect('localhost', 'root', '');

$q1 = 'CREATE DATABASE HMS';

try {
    if ($con->query($q1)) {
        echo "Database Created Successfullly";
    }
} catch (Exception) {
    echo "Error in creating Database";
}
