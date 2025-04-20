<?php
// confirm_booking.php
include_once('db_connection.php');
session_start();

// Get and sanitize the room number from query string
$room_no = isset($_GET['room_no']) ? intval($_GET['room_no']) : 0;
if ($room_no <= 0) {
    header('Location: rooms.php');
    exit;
}

// Fetch room details
$sql = "SELECT * FROM rooms WHERE room_no = $room_no AND room_status = 'Available'";
$result = mysqli_query($con, $sql);
if (!$result || mysqli_num_rows($result) !== 1) {
    header('Location: rooms.php');
    exit;
}
$room = mysqli_fetch_assoc($result);

// Fetch logged-in user details via session email
$user_name = '';
$user_phone = '';
$user_address = '';
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql_user = "SELECT fullname, mobile_no, address FROM users WHERE email = '$email' LIMIT 1";
    $res_user = mysqli_query($con, $sql_user);
    if ($res_user && mysqli_num_rows($res_user) === 1) {
        $user = mysqli_fetch_assoc($res_user);
        $user_name = $user['fullname'];
        $user_phone = $user['mobile_no'];
        $user_address = $user['address'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking - Room <?php echo $room['room_no']; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include_once('header.php'); ?>

    <div class="container py-5">
        <div class="page-title text-center mb-4">
            <p class="overlay-text h2">Confirm Booking</p>
        </div><br><br>

        <div class="row">
            <!-- Room Details Column -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="assets/images/rooms/<?php echo $room['image']; ?>" class="card-img-top" alt="Room Image" style="height:100%; object-fit:cover;">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $room['room_type']; ?></h4>
                        <p class="card-text"><strong>Price:</strong> <?php echo $room['price']; ?> Rs / Night</p>
                    </div>
                </div>
            </div>

            <!-- Booking Form Column -->
            <div class="col-md-6">
                <div class="card p-4" style="height:100%;">
                    <h5 class="mb-4">Your Details</h5>
                    <form action="process_booking.php" method="post">
                        <input type="hidden" name="room_no" value="<?php echo $room['room_no']; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="guest_name">Name</label>
                                <input type="text" class="form-control" id="guest_name" name="guest_name" value="<?php echo $user_name; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="guest_phone">Phone</label>
                                <input type="tel" class="form-control" id="guest_phone" name="guest_phone" value="<?php echo $user_phone; ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="guest_address">Address</label>
                                <textarea class="form-control" id="guest_address" name="guest_address" rows="2" required><?php echo $user_address; ?></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="check_in">Check-in</label>
                                <input type="date" class="form-control" id="check_in" name="check_in" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="check_out">Check-out</label>
                                <input type="date" class="form-control" id="check_out" name="check_out" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>