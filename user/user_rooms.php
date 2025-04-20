<?php
include_once('../db_connection.php');
include_once('../auth_check.php');
$roomType = isset($_GET['room_type']) ? $_GET['room_type'] : '';

$sql = "SELECT * FROM rooms WHERE room_status = 'Available'";
if (!empty($roomType)) {
    $sql .= " AND room_type = '" . mysqli_real_escape_string($con, $roomType) . "'";
}

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Rooms">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($roomType) ? $roomType . " Rooms" : "All Rooms"; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <?php include_once('user_header.php'); ?>

    <div class="container py-5">
        <div class="page-title text-center">
            <h1><?php echo !empty($roomType) ? $roomType . " Rooms" : "All Rooms"; ?></h1>
            <p class="overlay-text">Our Accommodations</p>
        </div>

        <section class="rooms-section spad">
            <div class="container">
                <div class="row">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($room = mysqli_fetch_assoc($result)): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="room-item">
                                    <img src="../assets/images/rooms/<?php echo $room['image']; ?>" alt="Room Image" class="img-fluid" style="height:200px; width:100%; object-fit:cover;">
                                    <div class="ri-text p-3">
                                        <h4><?php echo $room['room_type']; ?></h4>
                                        <h3><?php echo $room['price']; ?> Rs.<span>/Per Night</span></h3>
                                        <table class="table table-sm mt-2">
                                            <tbody>
                                                <tr>
                                                    <td class="r-o">Room No:</td>
                                                    <td><?php echo $room['room_no']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Size:</td>
                                                    <td><?php echo $room['size']; ?> ft</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Capacity:</td>
                                                    <td>Max person <?php echo $room['capacity']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Bed:</td>
                                                    <td><?php echo $room['bed']; ?> Bed(s)</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Services:</td>
                                                    <td><?php echo $room['services']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-info mr-2" style="background-color: #fca311;" onclick="window.location.href='user_room_detail.php?room_no=<?php echo $room['room_no']; ?>'">More Details</button>
                                            &nbsp;&nbsp;<button type="button" class="btn btn-success" onclick="handleBook(<?php echo $room['room_no']; ?>, <?php echo $room['price']; ?>)">Book Now</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12 text-center">
                            <h4>No rooms available<?php echo !empty($roomType) ? ' for ' . $roomType : ''; ?></h4>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='rooms.php'">View All Rooms</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>

    <?php include_once('user_footer.php'); ?>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        var isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;

        function handleBook(roomNo, price) {
            if (isLoggedIn) {
                window.location.href = 'user_confirm_booking.php?room_no=' + roomNo + '&price=' + price;
            } else {
                alert('Please login to book first!');
            }
        }
    </script>
</body>

</html>