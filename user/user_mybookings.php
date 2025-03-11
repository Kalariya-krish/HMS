<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

$id = $_SESSION['id'];
$email = $_SESSION['email'];

// Fetch user bookings
$query = "SELECT b.*, r.image FROM bookings b 
          JOIN rooms r ON b.room_no = r.room_no
          WHERE b.user_id = $id ORDER BY b.created_at DESC";
$result = mysqli_query($con, $query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $room_no = $_POST['room_no'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    // Check if the user already submitted a review for this room
    $checkQuery = "SELECT * FROM reviews WHERE user_id = '$user_id' AND room_no = '$room_no'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "You have already reviewed this room!";
    } else {
        $query = "INSERT INTO reviews (user_id, room_no, rating, review_text, created_at) 
                  VALUES ('$user_id', '$room_no', '$rating', '$review_text', NOW())";

        if (mysqli_query($con, $query)) {
            echo "Review submitted successfully!";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
                            <th scope="col">Room</th>
                            <th scope="col">Check-in</th>
                            <th scope="col">Check-out</th>
                            <th scope="col">Guests</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $modals = ""; // Store modal content separately

                        while ($row = mysqli_fetch_assoc($result)) {
                            $booking_id = $row['booking_id'];
                            $room_no = $row['room_no'];
                            $check_in = $row['check_in'];
                            $check_out = $row['check_out'];
                            $guests = $row['guests'];
                            $status = $row['status'];
                            $image = $row['image'];

                            // Check if the user has reviewed this room
                            $reviewQuery = "SELECT * FROM reviews WHERE user_id = '$id' AND room_no = '$room_no'";
                            $reviewResult = mysqli_query($con, $reviewQuery);
                            $hasReviewed = mysqli_num_rows($reviewResult) > 0;
                        ?>
                            <tr>
                                <th scope="row"><?php echo $count++; ?></th>
                                <td>
                                    <img src="../assets/images/rooms/<?php echo $image; ?>" alt="Room Image" width="80px" height="60px" class="rounded">
                                    <br>Room No: <?php echo $room_no; ?>
                                </td>
                                <td><?php echo $check_in; ?></td>
                                <td><?php echo $check_out; ?></td>
                                <td><?php echo $guests; ?></td>
                                <td>
                                    <span class="badge <?php echo ($status == 'Confirmed') ? 'bg-success' : 'bg-warning'; ?>">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal<?php echo $booking_id; ?>">View Details</button>

                                    <?php if (!$hasReviewed) { ?>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reviewModal<?php echo $room_no; ?>">Give Review</button>
                                    <?php } ?>
                                </td>
                            </tr>

                            <!-- Review Modal -->
                            <div class="modal fade" id="reviewModal<?php echo $room_no; ?>" tabindex="-1" aria-labelledby="reviewModalLabel<?php echo $room_no; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reviewModalLabel<?php echo $room_no; ?>">Give Review for Room No: <?php echo $room_no; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="reviewForm<?php echo $room_no; ?>">
                                                <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="room_no" value="<?php echo $room_no; ?>">
                                                <div class="mb-3">
                                                    <label for="rating<?php echo $room_no; ?>" class="form-label">Rating (1-5)</label>
                                                    <input type="number" class="form-control" name="rating" min="1" max="5" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="review<?php echo $room_no; ?>" class="form-label">Review</label>
                                                    <textarea class="form-control" name="review_text" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Review</button>
                                            </form>
                                        </div>
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
                <a href="rooms.php" class="btn btn-primary">Browse Rooms</a>
            </div>
        <?php } ?>
    </div>

    <?php include_once('user_footer.php'); ?>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function(){
    $("form[id^='reviewForm']").submit(function(e){
        e.preventDefault(); // Prevent page reload

        var form = $(this);
        var formData = form.serialize(); // Get form data

        $.ajax({
            type: "POST",
            url: "insert_review.php", // Separate PHP file for inserting the review
            data: formData,
            success: function(response) {
                alert(response); // Show success message
                location.reload(); // Reload page to update UI
            }
        });
    });
});
    </script>
</body>

</html>
