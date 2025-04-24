<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING);
ob_start();
session_start();

require_once('../tcpdf/tcpdf.php');
include_once('../db_connection.php');
include_once('../auth_check.php');

if (!isset($_GET['booking_id'])) {
    die("Booking ID missing.");
}

$booking_id = $_GET['booking_id'];
$user_id = $_SESSION['id'];

$query = "SELECT b.*, r.room_type, r.price, r.description
          FROM bookings b
          JOIN rooms r ON b.room_no = r.room_no
          WHERE b.id = '$booking_id' AND b.user_id = '$user_id'";
$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Booking not found.");
}

$row = mysqli_fetch_assoc($result);

// Extracting info
$room_type = $row['room_type'];
$room_no = $row['room_no'];
$price = $row['price'];
$check_in = $row['check_in'];
$check_out = $row['check_out'];
$amount = $row['amount'];
$fullname = $row['fullname'];
$mobile_no = $row['mobile_no'];
$address = $row['address'];
$email = $_SESSION['email'];
$payment_id = $row['payment_id'];
$created_at = $row['created_at'];

$checkInDate = new DateTime($check_in);
$checkOutDate = new DateTime($check_out);
$nights = $checkInDate->diff($checkOutDate)->days;

$accentColor = [44, 62, 80]; // #2C3E50

$pdf = new TCPDF();
$pdf->SetTitle('Hotel Booking Invoice');
$pdf->AddPage();
$pdf->SetMargins(15, 15, 15);

// Header
$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetTextColor(...$accentColor);
$pdf->Cell(0, 10, 'Astoria Hotel', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 7, 'Booking Invoice', 0, 1, 'C');
$pdf->Ln(2);

// Hotel Address
$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(0, 5, "Hotel Address: 123 City Road, Metropolis, India - 560001\nPhone: +91 9727428844 | Email: support@Astoria.com\n\n", 0, 'C');
$pdf->Ln(5);

// Info Section Headers
$pdf->SetFillColor(...$accentColor);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 8, 'INVOICE DETAILS', 0, 1, 'L', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 11);

// Invoice Info
$pdf->MultiCell(90, 5, "\nInvoice Date: " . date('M d, Y') . "\nBooking ID: #$booking_id\nPayment ID: $payment_id\nBooking Created: " . date('M d, Y', strtotime($created_at)), 0, 'L', 0, 0);
$pdf->MultiCell(90, 5, "\nGuest Name: $fullname\nEmail: $email\nPhone: $mobile_no\nAddress: $address", 0, 'R');
$pdf->Ln(10);

// Booking Details Section
$pdf->SetFillColor(...$accentColor);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 8, 'BOOKING DETAILS', 0, 1, 'L', true);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 11);

// Table Header
$pdf->SetFillColor(220, 220, 220);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(40, 8, 'Room Type', 1, 0, 'C', 1);
$pdf->Cell(25, 8, 'Room No', 1, 0, 'C', 1);
$pdf->Cell(30, 8, 'Check-in', 1, 0, 'C', 1);
$pdf->Cell(30, 8, 'Check-out', 1, 0, 'C', 1);
$pdf->Cell(20, 8, 'Nights', 1, 0, 'C', 1);
$pdf->Cell(35, 8, 'Price/Night', 1, 1, 'C', 1);

// Table Data
$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(40, 8, $room_type, 1);
$pdf->Cell(25, 8, $room_no, 1);
$pdf->Cell(30, 8, $check_in, 1);
$pdf->Cell(30, 8, $check_out, 1);
$pdf->Cell(20, 8, $nights, 1);
$pdf->Cell(35, 8, 'Rs.' . number_format($price, 2), 1, 1);

// Total
$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(180, 8, 'Total Amount Paid: Rs.' . number_format($amount, 2), 0, 1, 'R');

// Footer Note
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'I', 10);
$pdf->SetTextColor(128, 128, 128);
$pdf->MultiCell(0, 6, "Thank you for choosing Astoria Hotel.\nWe hope you had a comfortable stay!", 0, 'C');
$pdf->Ln(5);
$pdf->MultiCell(0, 5, "Terms: This is a computer-generated invoice.", 0, 'C');

// Output
ob_end_clean();
$pdf->Output("booking_invoice_$booking_id.pdf", 'D');
