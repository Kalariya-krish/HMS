<?php
require_once('../vendor/razorpay/razorpay/Razorpay.php'); // Include Razorpay SDK
include_once('../db_connection.php');

use Razorpay\Api\Api;

$api = new Api('rzp_test_gKgQuJWNMwZxDg', 'qgZhV2DJb72rjR0Qc7b1lzDB');

$amount = $_POST['amount'] * 100; // Convert to paise

try {
    $order = $api->order->create([
        'amount' => $amount,
        'currency' => 'INR',
        'receipt' => 'receipt_' . time(),
        'payment_capture' => 1 // auto capture
    ]);

    header('Content-Type: application/json');
    echo json_encode(['id' => $order->id]);
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
