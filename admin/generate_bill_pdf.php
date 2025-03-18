<?php
// generate_bill_pdf.php

include_once('../db_connection.php');
include_once('../auth_check.php');

// Include the FPDF library; adjust the path as needed.
require('../assets/fpdf/fpdf.php');

if (!isset($_GET['bill_id'])) {
    die("Bill ID not provided.");
}

$bill_id = intval($_GET['bill_id']);

// Fetch the bill details along with customer name and room number
$query = "SELECT b.*, u.fullname AS customer_name, bk.room_no 
          FROM bills b 
          JOIN users u ON b.user_id = u.id 
          JOIN bookings bk ON b.booking_id = bk.booking_id 
          WHERE b.bill_id = '$bill_id' LIMIT 1";
$result = mysqli_query($con, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Bill not found.");
}
$bill = mysqli_fetch_assoc($result);

// Create a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Set some fonts and styles
$pdf->SetFont('Arial', 'B', 16);
$pdf->Image('../assets/images/logo.png', 10, 6, 30); // Insert logo image
$pdf->Cell(0, 10, 'Hotel Bill Invoice', 0, 1, 'C');
$pdf->Ln(10);

// Bill Information Title
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Bill Details', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Bill ID: ', 0, 0);
$pdf->Cell(0, 10, $bill['bill_id'], 0, 1);

$pdf->Cell(50, 10, 'Customer Name: ', 0, 0);
$pdf->Cell(0, 10, $bill['customer_name'], 0, 1);

$pdf->Cell(50, 10, 'Room Number: ', 0, 0);
$pdf->Cell(0, 10, $bill['room_no'], 0, 1);

$pdf->Cell(50, 10, 'Amount: ', 0, 0);
$pdf->Cell(0, 10, '$' . number_format($bill['amount'], 2), 0, 1);

$pdf->Cell(50, 10, 'Generated At: ', 0, 0);
$pdf->Cell(0, 10, $bill['generated_at'], 0, 1);

$pdf->Cell(50, 10, 'Payment Status: ', 0, 0);
$pdf->Cell(0, 10, ucfirst($bill['payment_status']), 0, 1);

$pdf->Ln(15);

// Itemized Bill Table (if any, e.g., room service, discounts, etc.)
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Itemized Bill', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 10, 'Description', 1);
$pdf->Cell(30, 10, 'Amount', 1, 1);

$pdf->Cell(100, 10, 'Room Charges', 1);
$pdf->Cell(30, 10, '$' . number_format($bill['amount'], 2), 1, 1);

// Additional items can be added in a similar way (e.g., room service, taxes, etc.)

// Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 10, 'Total Amount', 1);
$pdf->Cell(30, 10, '$' . number_format($bill['amount'], 2), 1, 1);

// Footer
$pdf->Ln(15);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Thank you for choosing our hotel! We hope to serve you again.', 0, 1, 'C');

// Define the folder to store PDFs and create it if it doesn't exist
$folder = '../assets/billpdfs/';
if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}
$pdf_filename = 'bill_' . $bill['bill_id'] . '.pdf';
$pdf_full_path = $folder . $pdf_filename;

// Save the PDF file on the server
$pdf->Output('F', $pdf_full_path);

// Optionally, update the bill record with the PDF path (only filename is stored in DB)
$update_query = "UPDATE bills SET pdf_path = '$pdf_filename' WHERE bill_id = '$bill_id'";
mysqli_query($con, $update_query);

// Redirect to the PDF file so it opens in a new tab
header("Location: /hms/assets/billpdfs/$pdf_filename");
exit();
