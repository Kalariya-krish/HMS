<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Ensure user is logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$user_id = $_SESSION['id'];
$email = $_SESSION['email'];

// Fetch user bookings
$query = "SELECT * FROM bookings WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="../assets/css/user_mybooking_style.css">
</head>

<body>
    <?php include_once('user_header.php'); ?>

    <div class="container py-5">
        <div class="page-header text-center">
            <h1>My Bookings</h1>
            <p class="overlay-text">My Reservations</p>
        </div>

        <div class="row">
            <div class="col-12">
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) {
                        $booking_id = $row['booking_id'];
                        $room_no = $row['room_no'];
                        $check_in = $row['check_in'];
                        $check_out = $row['check_out'];
                        $guests = $row['guests'];
                        $status = $row['status'];
                        $checkin_status = $row['checkin_status'];

                        // Check if the user has already reviewed this room
                        $reviewQuery = "SELECT * FROM reviews WHERE user_id = '$user_id' AND room_no = '$room_no'";
                        $reviewResult = mysqli_query($con, $reviewQuery);
                        $hasReviewed = mysqli_num_rows($reviewResult) > 0;
                    ?>
                        <div class="booking-card p-4">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <img src="../assets/images/room/room<?php echo $room_no; ?>.jpg" alt="Room Image" class="img-fluid rounded">
                                </div>
                                <div class="col-md-6">
                                    <h4>Room No: <?php echo $room_no; ?></h4>
                                    <p>
                                        <strong>Booking ID:</strong> #<?php echo $booking_id; ?><br>
                                        <strong>Check-in:</strong> <?php echo $check_in; ?><br>
                                        <strong>Check-out:</strong> <?php echo $check_out; ?><br>
                                        <strong>Guests:</strong> <?php echo $guests; ?>
                                    </p>
                                </div>
                                <div class="col-md-3 text-end">
                                    <span class="booking-status <?php echo ($status == "Confirmed") ? "status-confirmed" : "status-pending"; ?>">
                                        <?php echo $status; ?>
                                    </span><br>

                                    <button class="booking-detail view-detail" onclick="viewBookingDetails(<?php echo $booking_id; ?>)">
                                        View Details
                                    </button><br>

                                    <?php if (!$hasReviewed && $status == "Confirmed") { ?>
                                        <button class="btn btn-warning mt-2" onclick="giveReview(<?php echo $room_no; ?>)">Give Review</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="text-center py-5" id="no-bookings">
                        <h4>You have no current bookings</h4>
                        <p>Explore our rooms and make a reservation!</p>
                        <a href="rooms.php" class="btn btn-primary">Browse Rooms</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php include_once('user_footer.php'); ?>

    <script>
        function viewBookingDetails(bookingId) {
            window.location.href = "booking_details.php?booking_id=" + bookingId;
        }

        function giveReview(roomNo) {
            window.location.href = "review.php?room_no=" + roomNo;
        }
    </script>
</body>

</html>