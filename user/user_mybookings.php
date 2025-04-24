<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

$id = $_SESSION['id'];
$email = $_SESSION['email'];

// Fetch user bookings with more details
$query = "SELECT b.*, r.image, r.room_type, r.price, r.description 
          FROM bookings b 
          JOIN rooms r ON b.room_no = r.room_no
          WHERE b.user_id = '$id' && b.status = 'Confirmed' ORDER BY b.created_at DESC";
$result = mysqli_query($con, $query);

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    $user_id = $_POST['user_id'];
    $room_no = $_POST['room_no'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    $insertQuery = "INSERT INTO reviews (user_id, room_no, rating, review_text, created_at) 
                        VALUES ('$user_id', '$room_no', '$rating', '$review_text', NOW())";

    if (mysqli_query($con, $insertQuery)) {
        header("Location: user_mybookings.php?success=Review submitted successfully.");
    } else {
        header("Location: user_mybookings.php?error=Error in review submitting " . mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add to the head section of your page -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        /* Fix for modal content visibility */
        .modal-content {
            color: #212529 !important;
            /* Ensure text is dark */
            background-color: #ffffff !important;
            /* Ensure background is white */
        }

        /* Fix for form controls in modal */
        .modal input,
        .modal textarea {
            background-color: #ffffff !important;
            color: #212529 !important;
        }

        /* Room image in modal */
        .room-image-modal {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        /* Booking info section */
        .booking-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        /* Room info section */
        .room-info {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <?php include_once('user_header.php'); ?>

    <div class="container py-5">
        <h1 class="text-center mb-4">My Bookings</h1><br>

        <!-- Display Success/Error Messages -->
        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_GET['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_GET['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Room</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $booking_id = $row['id'];
                            $room_no = $row['room_no'];
                            $check_in = $row['check_in'];
                            $check_out = $row['check_out'];
                            $status = $row['status'];
                            $image = $row['image'];
                            $fullname = $row['fullname'];
                            $mobile_no = $row['mobile_no'];
                            $address = $row['address'];
                            $amount = $row['amount'];
                            $payment_id = $row['payment_id'];
                            $created_at = $row['created_at'];

                            // Room details
                            $room_type = $row['room_type'];
                            $price_per_night = $row['price'];
                            $description = $row['description'];

                            $today = date("Y-m-d");

                            // Check if already reviewed
                            $reviewQuery = "SELECT * FROM reviews WHERE user_id = '$id' AND room_no = '$room_no'";
                            $reviewResult = mysqli_query($con, $reviewQuery);
                            $hasReviewed = mysqli_num_rows($reviewResult) > 0;
                        ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td>
                                    <img src="../assets/images/rooms/<?php echo $image; ?>" width="80" height="60" class="rounded mb-1">
                                    <br>Room No: <?php echo $room_no; ?>
                                </td>
                                <td><?php echo $check_in; ?></td>
                                <td><?php echo $check_out; ?></td>
                                <td>
                                    <span class="badge bg-<?php echo ($status == 'Confirmed') ? 'success' : 'warning'; ?>">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal<?php echo $booking_id; ?>">View</button>

                                    <?php if (!$hasReviewed && $status == 'Confirmed' && $check_out < $today) { ?>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reviewModal<?php echo $booking_id; ?>">Review</button>
                                    <?php } ?>

                                    <a href="download_bill.php?booking_id=<?php echo $booking_id; ?>" class="btn btn-success btn-sm">
                                        <i class="bi bi-download"></i> Download Bill
                                    </a>
                                </td>
                            </tr>

                            <!-- Details Modal -->
                            <div class="modal fade" id="detailsModal<?php echo $booking_id; ?>" tabindex="-1" aria-labelledby="detailsModalLabel<?php echo $booking_id; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title" id="detailsModalLabel<?php echo $booking_id; ?>">Booking #<?php echo $booking_id; ?> Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Room Image and Quick Info Card -->
                                            <div class="card mb-4">
                                                <div class="row g-0">
                                                    <div class="col-md-5">
                                                        <img src="../assets/images/rooms/<?php echo $image; ?>" class="img-fluid rounded-start h-100" alt="Room Image" style="object-fit: cover;">
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="card-body">
                                                            <h4 class="card-title"><?php echo $room_type; ?> - Room <?php echo $room_no; ?></h4>
                                                            <p class="card-text"><?php echo $description; ?></p>
                                                            <p class="card-text"><small class="text-muted">$<?php echo $price_per_night; ?> per night</small></p>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <span class="badge bg-<?php echo ($status == 'Confirmed') ? 'success' : 'warning'; ?> p-2">
                                                                    <?php echo $status; ?>
                                                                </span>
                                                                <span class="text-muted">Booked on: <?php echo date('M d, Y', strtotime($created_at)); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Two columns for Booking and Guest Details -->
                                            <div class="row">
                                                <!-- Booking Details -->
                                                <div class="col-md-6">
                                                    <div class="card h-100">
                                                        <div class="card-header bg-primary text-white">
                                                            <h5 class="mb-0">Booking Information</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                    Check-in Date:
                                                                    <span class="badge bg-light text-dark"><?php echo date('M d, Y', strtotime($check_in)); ?></span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                    Check-out Date:
                                                                    <span class="badge bg-light text-dark"><?php echo date('M d, Y', strtotime($check_out)); ?></span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                    Total Amount:
                                                                    <span class="badge bg-success">$<?php echo $amount; ?></span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                    Payment ID:
                                                                    <span class="badge bg-light text-dark"><?php echo $payment_id; ?></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Guest Details -->
                                                <div class="col-md-6">
                                                    <div class="card h-100">
                                                        <div class="card-header bg-secondary text-white">
                                                            <h5 class="mb-0">Guest Information</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">
                                                                    <i class="bi bi-person-fill"></i> <strong>Name:</strong> <?php echo $fullname; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <i class="bi bi-telephone-fill"></i> <strong>Phone:</strong> <?php echo $mobile_no; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <i class="bi bi-envelope-fill"></i> <strong>Email:</strong> <?php echo $email; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <i class="bi bi-geo-alt-fill"></i> <strong>Address:</strong> <?php echo $address; ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <?php if (!$hasReviewed && $status == 'Confirmed') { ?>
                                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#reviewModal<?php echo $booking_id; ?>" data-bs-dismiss="modal">
                                                    <i class="bi bi-star-fill me-1"></i> Write Review
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Review Modal -->
                            <div class="modal fade" id="reviewModal<?php echo $booking_id; ?>" tabindex="-1" aria-labelledby="reviewModalLabel<?php echo $booking_id; ?>" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reviewModalLabel<?php echo $booking_id; ?>">Review Room No: <?php echo $room_no; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="room_no" value="<?php echo $room_no; ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Rating (1-5)</label>
                                                    <input type="number" name="rating" class="form-control" min="1" max="5" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Review</label>
                                                    <textarea name="review_text" class="form-control" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="submit_review" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="text-center py-5">
                <h4>You have no current bookings</h4>
                <p>Explore our rooms and make a reservation!</p>
                <a href="user_rooms.php" class="btn btn-primary">Browse Rooms</a>
            </div>
        <?php } ?>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>