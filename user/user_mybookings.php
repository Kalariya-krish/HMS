<?php
include_once('../db_connection.php');
include_once('../auth_check.php');
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
    <?php
    include_once('user_header.php');
    ?>

    <div class="container py-5">
        <!-- Page Header -->
        <div class="page-header text-center">
            <h1>&nbsp;&nbsp;&nbsp;Bookings</h1>
            <p class="overlay-text">My Reservations</p>
        </div>
        <!-- Breadcrumb Section End -->

        <!-- Bookings Section -->
        <div class="row">
            <div class="col-12">
                <!-- Booking Card 1 -->
                <div class="booking-card p-4">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img src="../assets/images/room/room1.jpg" alt="Room Image" class="img-fluid rounded">
                        </div>
                        <div class="col-md-6">
                            <h4>Deluxe Sea View Room</h4>
                            <p>
                                <strong>Booking ID:</strong> #B12345<br>
                                <strong>Check-in:</strong> 15 March 2024<br>
                                <strong>Check-out:</strong> 18 March 2024<br>
                                <strong>Guests:</strong> 2 Adults
                            </p>
                        </div>
                        <div class="col-md-3 text-end">
                            <span class="booking-status status-confirmed">Confirmed</span>
                            <button class="booking-detail view-detail">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- Booking Card 2 -->
                <div class="booking-card p-4">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img src="../assets/images/room/room2.jpg" alt="Room Image" class="img-fluid rounded">
                        </div>
                        <div class="col-md-6">
                            <h4>Standard Room</h4>
                            <p>
                                <strong>Booking ID:</strong> #B12346<br>
                                <strong>Check-in:</strong> 22 April 2024<br>
                                <strong>Check-out:</strong> 25 April 2024<br>
                                <strong>Guests:</strong> 1 Adult
                            </p>
                        </div>
                        <div class="col-md-3 text-end">
                            <span class="booking-status status-pending">Pending</span>
                            <button class="booking-detail view-detail">View Details</button>
                        </div>
                    </div>
                </div>

                <!-- No Bookings Message (Conditionally Shown) -->
                <div class="text-center py-5" id="no-bookings" style="display: none;">
                    <h4>You have no current bookings</h4>
                    <p>Explore our rooms and make a reservation!</p>
                    <a href="rooms.html" class="btn btn-primary">Browse Rooms</a>
                </div>
            </div>
        </div>
        <br><br>
    </div>
    <?php
    include_once('user_footer.php');
    ?>
</body>

</html>