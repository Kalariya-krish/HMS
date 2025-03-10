<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

$roomType = isset($_GET['room_type']) ? $_GET['room_type'] : '';

$sql = "SELECT * FROM rooms WHERE room_status = 'Available'";
if (!empty($roomType)) {
    $sql .= " AND room_type = '$roomType'";
}

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Rooms">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($roomType) ? "$roomType Rooms" : "All Rooms"; ?></title>
</head>

<body>
    <?php include_once('user_header.php'); ?>

    <div class="container py-5">
        <div class="page-title text-center">
            <h1><?php echo !empty($roomType) ? "$roomType Rooms" : "Rooms"; ?></h1>
            <p class="overlay-text">Our Accommodations</p>
        </div>

        <section class="rooms-section spad">
            <div class="container">
                <div class="row">
                    <?php if (mysqli_num_rows($result) > 0) : ?>
                        <?php while ($room = mysqli_fetch_assoc($result)) : ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="room-item">
                                    <img src="assets/images/rooms/<?php echo $room['image']; ?>" alt="Room Image" height="200px" width="200px">
                                    <div class="ri-text">
                                        <h4><?php echo $room['room_type']; ?></h4>
                                        <h3><?php echo $room['price']; ?> Rs.<span>/Per Night</span></h3>
                                        <table>
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
                                        <a href="room_detail.php?room_no=<?php echo $room['room_no']; ?>" class="primary-btn">More Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <div class="col-12 text-center">
                            <h4>No rooms available for <?php echo $roomType; ?></h4>
                            <a href="user_rooms.php" class="btn btn-primary">View All Rooms</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>

    <?php include('user_footer.php'); ?>
</body>

</html>