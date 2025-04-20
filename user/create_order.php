<?php
require('../vendor/autoload.php');

use Razorpay\Api\Api;

$keyId = 'rzp_test_gKgQuJWNMwZxDg';
$keySecret = 'qgZhV2DJb72rjR0Qc7b1lzDB';

$api = new Api($keyId, $keySecret);

$amount = $_POST['amount']; // in rupees

$order = $api->order->create([
    'receipt' => 'RCPT_' . rand(1000, 9999),
    'amount' => $amount * 100, // amount in paisa
    'currency' => 'INR',
    'payment_capture' => 1
]);

echo json_encode($order);
