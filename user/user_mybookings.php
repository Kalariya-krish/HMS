<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Ensure user is logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];
$email = $_SESSION['email'];

// Fetch user bookings
$query = "SELECT * FROM bookings WHERE user_id = $id ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include_once('user_header.php'); ?>

    <div class="container py-5">
        <div class="page-header text-center">
            <h1>My Bookings</h1>
            <p class="overlay-text">My Reservations</p>
        </div>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Room No</th>
                            <th scope="col">Check-in</th>
                            <th scope="col">Check-out</th>
                            <th scope="col">Guests</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $booking_id = $row['booking_id'];
                            $room_no = $row['room_no'];
                            $check_in = $row['check_in'];
                            $check_out = $row['check_out'];
                            $guests = $row['guests'];
                            $status = $row['status'];

                            // Check if the user has reviewed this room
                            $reviewQuery = "SELECT * FROM reviews WHERE user_id = '$id' AND room_no = '$room_no'";
                            $reviewResult = mysqli_query($con, $reviewQuery);
                            $hasReviewed = mysqli_num_rows($reviewResult) > 0;
                        ?>
                            <tr>
                                <th scope="row"><?php echo $count++; ?></th>
                                <td><?php echo $room_no; ?></td>
                                <td><?php echo $check_in; ?></td>
                                <td><?php echo $check_out; ?></td>
                                <td><?php echo $guests; ?></td>
                                <td>
                                    <span class="badge <?php echo ($status == 'Confirmed') ? 'bg-success' : 'bg-warning'; ?>">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="booking_details.php?booking_id=<?php echo $booking_id; ?>" class="btn btn-info btn-sm">View Details</a>
                                    <?php if (!$hasReviewed && $status == "Confirmed") { ?>
                                        <a href="review.php?room_no=<?php echo $room_no; ?>" class="btn btn-warning btn-sm">Give Review</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="text-center py-5">
                <h4>You have no current bookings</h4>
                <p>Explore our rooms and make a reservation!</p>
                <a href="rooms.php" class="btn btn-primary">Browse Rooms</a>
            </div>
        <?php } ?>
    </div>

    <?php include_once('user_footer.php'); ?>

</body>

</html>