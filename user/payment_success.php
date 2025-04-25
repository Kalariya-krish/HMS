<?php
session_start();
include_once('../db_connection.php');

if (isset($_GET['payment_id'])) {
    // Get payment and session details
    $payment_id = $_GET['payment_id'];
    $order_id = $_SESSION['order_id'] ?? '';
    $room_no = $_SESSION['current_room_no'] ?? '';
    $user_email = $_SESSION['email'] ?? '';
    $user_id = $_SESSION['user_id'] ?? '';
    $fullname = $_SESSION['fullname'] ?? '';
    $mobile_no = $_SESSION['mobile_no'] ?? '';
    $address = $_SESSION['address'] ?? '';
    $check_in = $_SESSION['check_in'] ?? '';
    $check_out = $_SESSION['check_out'] ?? '';
    $amount_paid = $_SESSION['total'] ?? '0.00';
    $currency = 'INR'; // Razorpay default currency
    $payment_method = 'Online'; // You can replace this with real data from Razorpay API if needed
    $status = 'Confirmed';
    $description = "Room booking for room number $room_no";

    // Sanitize inputs (recommended for security)
    $payment_id = mysqli_real_escape_string($con, $payment_id);
    $order_id = mysqli_real_escape_string($con, $order_id);

    // Insert into bookings table
    $booking_query = "INSERT INTO bookings (
        email, user_id, fullname, mobile_no, address, room_no, check_in, check_out, amount, payment_id, status
    ) VALUES (
        '$user_email', '$user_id', '$fullname', '$mobile_no', '$address', '$room_no', '$check_in', '$check_out', '$amount_paid', '$payment_id', '$status'
    )";

    $booking_success = mysqli_query($con, $booking_query);

    // Insert into payment table
    $payment_query = "INSERT INTO payment (
        payment_id, order_id, email, amount, currency, status, method, description
    ) VALUES (
        '$payment_id', '$order_id', '$user_email', '$amount_paid', '$currency', '$status', '$payment_method', '$description'
    )";

    $payment_success = mysqli_query($con, $payment_query);

    // Final actions
    if ($booking_success && $payment_success) {
        // Mark room as booked
        $update_room_status = "UPDATE rooms SET room_status = 'Booked' WHERE room_no = '$room_no'";
        mysqli_query($con, $update_room_status);

        echo "<h2 style='color: green;'>Payment Successful! Booking Confirmed.</h2>";
        echo "<p>Booking Details Saved. Payment ID: <strong>$payment_id</strong></p>";
    } else {
        echo "<h2 style='color: orange;'>Payment Successful but Booking/Payment Save Failed.</h2>";
        echo "<p>Please contact support with Payment ID: <strong>$payment_id</strong></p>";
    }
} else {
    echo "<h2 style='color: red;'>Invalid Payment Request.</h2>";
}
