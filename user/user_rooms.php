<?php
include_once('../db_connection.php');
include_once('../auth_check.php');
$roomType = isset($_GET['room_type']) ? $_GET['room_type'] : '';

// First, get all available rooms
$sql = "SELECT * FROM rooms WHERE room_status = 'Available'";
if (!empty($roomType)) {
    $sql .= " AND room_type = '" . mysqli_real_escape_string($con, $roomType) . "'";
}
$result = mysqli_query($con, $sql);

// Create an array to store average ratings for each room
$roomRatings = array();

// Get all approved reviews and calculate average ratings
$reviewsQuery = "SELECT room_no, AVG(rating) as avg_rating, COUNT(*) as review_count 
                 FROM reviews 
                 WHERE status = 'Approved' 
                 GROUP BY room_no";
$reviewsResult = mysqli_query($con, $reviewsQuery);

while ($row = mysqli_fetch_assoc($reviewsResult)) {
    $roomRatings[$row['room_no']] = array(
        'avg_rating' => round($row['avg_rating'], 1),
        'review_count' => $row['review_count']
    );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Rooms">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($roomType) ? $roomType . " Rooms" : "All Rooms"; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .price-section,
        .price-section del,
        .price-section span,
        .price-section h3,
        .table.table-sm,
        .table.table-sm td {
            font-family: 'Arial', sans-serif;
        }

        .rating-stars {
            color: #ffc107;
            /* Gold color for stars */
            font-size: 18px;
        }

        .rating-text {
            font-size: 14px;
            margin-left: 5px;
            color: #6c757d;
        }
    </style>
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

                                        <!-- Rating display -->
                                        <div class="room-rating mb-2">
                                            <?php
                                            $roomNo = $room['room_no'];
                                            $avgRating = isset($roomRatings[$roomNo]) ? $roomRatings[$roomNo]['avg_rating'] : 0;
                                            $reviewCount = isset($roomRatings[$roomNo]) ? $roomRatings[$roomNo]['review_count'] : 0;
                                            $fullStars = floor($avgRating);
                                            $hasHalfStar = ($avgRating - $fullStars) >= 0.5;

                                            // Display stars
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $fullStars) {
                                                    echo '<i class="fas fa-star rating-stars"></i>';
                                                } elseif ($i == $fullStars + 1 && $hasHalfStar) {
                                                    echo '<i class="fas fa-star-half-alt rating-stars"></i>';
                                                } else {
                                                    echo '<i class="far fa-star rating-stars"></i>';
                                                }
                                            }

                                            // Display rating text
                                            if ($reviewCount > 0) {
                                                echo '<span class="rating-text">' . $avgRating . ' (' . $reviewCount . ' reviews)</span>';
                                            } else {
                                                echo '<span class="rating-text">No reviews yet</span>';
                                            }
                                            ?>
                                        </div>

                                        <?php if ($room['discount'] > 0): ?>
                                            <div class="price-section">
                                                <del class="text-danger"><?php echo $room['price']; ?> Rs.</del>
                                                <span class="badge text-white" style="background-color: #0B032D;"><?php echo $room['discount']; ?>% Off</span>
                                                <h3><?php echo $room['discounted_price']; ?> Rs.<span>/Per Night</span></h3>
                                            </div>
                                        <?php else: ?>
                                            <h3><?php echo $room['price']; ?> Rs.<span>/Per Night</span></h3>
                                        <?php endif; ?>
                                        <br>
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
                                            &nbsp;&nbsp;<button style="background-color: #0B032D;" type="button" class="btn text-white" onclick="handleBook(<?php echo $room['room_no']; ?>, <?php echo $room['discounted_price']; ?>)">Book Now</button>
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