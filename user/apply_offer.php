<?php
// Add these at the very top
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('../db_connection.php');

header('Content-Type: application/json');

// Get the total price from POST if available (from date calculation)
$totalPrice = isset($_POST['total_price']) ? floatval($_POST['total_price']) : $roomPrice;

// Calculate discount based on total price
$discountPercentage = (float)$offer['discount_percentage'];
$discountAmount = ($totalPrice * $discountPercentage) / 100;
$finalTotal = $totalPrice - $discountAmount;

// Store in session
$_SESSION['discount_percentage'] = $discountPercentage;
$_SESSION['discount_amount'] = $discountAmount;  // Store actual discount amount
$_SESSION['total'] = $finalTotal;

// Verify database connection
if (!$con) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database connection failed',
        'db_error' => mysqli_connect_error()
    ]);
    exit;
}

try {
    // Get and sanitize input
    $offerCode = isset($_POST['offercode']) ? trim($_POST['offercode']) : '';
    $roomNo = isset($_POST['room_no']) ? intval($_POST['room_no']) : 0;
    $roomPrice = isset($_POST['room_price']) ? floatval($_POST['room_price']) : 0;

    // Validate inputs
    if (empty($offerCode)) {
        throw new Exception('Offer code is required');
    }

    if ($roomNo <= 0) {
        throw new Exception('Invalid room number');
    }

    if ($roomPrice <= 0) {
        throw new Exception('Invalid room price');
    }

    // Check if offer exists
    $sql = "SELECT * FROM offers WHERE offer_code = ? AND status = 'Active' AND valid_until >= CURDATE()";
    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        throw new Exception('Database query preparation failed: ' . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "s", $offerCode);
    $executeResult = mysqli_stmt_execute($stmt);

    if (!$executeResult) {
        throw new Exception('Database query failed: ' . mysqli_stmt_error($stmt));
    }

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 0) {
        throw new Exception('Invalid or expired offer code');
    }

    $offer = mysqli_fetch_assoc($result);

    // Calculate discount
    $discountPercentage = (float)$offer['discount_percentage'];
    $discountAmount = ($roomPrice * $discountPercentage) / 100;
    $finalTotal = $roomPrice - $discountAmount;

    // Store in session
    $_SESSION['offer_code'] = $offerCode;
    $_SESSION['discount_percentage'] = $discountPercentage;
    $_SESSION['discount'] = $discountAmount;
    $_SESSION['total'] = $finalTotal;
    $_SESSION['offer_status'] = 'Offer applied successfully';
    $_SESSION['status'] = 'success';

    // Return success
    echo json_encode([
        'status' => 'success',
        'message' => 'Offer applied successfully',
        'discount_percentage' => $discountPercentage,
        'discount_amount' => $discountAmount,
        'final_total' => $finalTotal
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}

exit;
