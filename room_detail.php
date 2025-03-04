<?php
session_start();
include('db_connection.php'); // Include database connection

if (isset($_GET['room_no'])) {
    $room_no = $_GET['room_no'];

    // Fetch room details from the database
    $query = "SELECT * FROM rooms WHERE room_no = $room_no";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $room_name = $row['room_name'];
        $price = $row['price'];
        $size = $row['size'];
        $capacity = $row['capacity'];
        $bed = $row['bed'];
        $services = $row['services'];
        $description = $row['description'];
        $image = $row['image'];
    } else {
        echo "<h2>Room Not Found!</h2>";
        exit;
    }

    $reviews = "SELECT r.review_id, r.rating, r.review_text, r.created_at, u.fullname, u.profile_picture
        FROM reviews r
        JOIN users u ON r.user_id = u.id
        WHERE r.room_no = $room_no";
    $result2 = mysqli_query($con, $reviews);
} else {
    echo "<h2>Invalid Room Request</h2>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
        header("Location: login.php"); // Redirect if not logged in
        exit();
    } else {
        $room_no = $_POST['room_no'];
        $user_id = $_SESSION['id']; // Get logged-in user ID
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];
        $guests = $_POST['guests'];

        // Insert booking into database
        $query = "INSERT INTO bookings (room_no, user_id, check_in, check_out, guests, created_at)
              VALUES ('$room_no', '$user_id', '$check_in', '$check_out', '$guests', NOW())";

        if (mysqli_query($con, $query)) {
            $response = ['success' => true, 'message' => 'Booking successful!'];
        } else {
            $response = ['success' => false, 'message' => 'Booking failed. Please try again.'];
        }

        echo json_encode($response);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $room_name; ?> - Room Detail</title>
</head>

<body>
    <?php
    include_once('header.php');
    ?>

    <div class="container py-5">
        <!-- Breadcrumb Section Begin -->
        <div class="page-title text-center">
            <h1><?php echo $room_name; ?></h1>
            <p class="overlay-text">Room Details</p>
        </div>
        <!-- Breadcrumb Section End -->

        <!-- Room Details Section Begin -->
        <section class="room-details-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="room-details-item">
                            <img src="assets/images/rooms/<?php echo $image; ?>" alt="Room Image" width="100%">
                            <div class="rd-text">
                                <div class="rd-title">
                                    <h3><?php echo $room_name; ?></h3>
                                    <div class="rdt-right">
                                        <div class="rating">
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star-half_alt"></i>
                                        </div>
                                        <a href="#">Booking Now</a>
                                    </div>
                                </div>
                                <h2><?php echo $price; ?> Rs.<span>/Per Night</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td><?php echo $size; ?> ft</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max <?php echo $capacity; ?> person(s)</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td><?php echo $bed; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td><?php echo nl2br(htmlspecialchars($services)); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><?php echo nl2br(htmlspecialchars($description)); ?></p>
                            </div>
                        </div>
                        <div class="rd-reviews">
                            <h4>Reviews</h4>
                            <?php while ($row = $result2->fetch_assoc()): ?>
                                <div class="review-item">
                                    <div class="ri-pic">
                                        <img src="assets/images/profile_picture/<?php echo $row['profile_picture']; ?>" alt="User Avatar">
                                    </div>
                                    <div class="ri-text">
                                        <span><?php echo date("d M Y", strtotime($row['created_at'])); ?></span>
                                        <div class="rating">
                                            <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo $i <= $row['rating'] ? '<i class="icon_star"></i>' : '<i class="icon_star_alt"></i>';
                                            }
                                            ?>
                                        </div>
                                        <h5><?php echo htmlspecialchars($row['fullname']); ?></h5>
                                        <p><?php echo htmlspecialchars($row['review_text']); ?></p>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <!-- <div class="container mt-4">
                            <div class="review-add card p-4 shadow-sm">
                                <h4 class="mb-3">Add Review</h4>
                                <form id="reviewForm" class="needs-validation">
                                    <input type="hidden" id="room_no" name="room_no" value="101">
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <label for="rating" class="form-label">Your Rating*</label>
                                            <select id="rating" name="rating" class="form-select">
                                                <option value="">Select Rating</option>
                                                <option value="1">1 Star</option>
                                                <option value="2">2 Stars</option>
                                                <option value="3">3 Stars</option>
                                                <option value="4">4 Stars</option>
                                                <option value="5">5 Stars</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label for="review" class="form-label">Your Review*</label>
                                            <textarea id="review" name="review" class="form-control" rows="4" placeholder="Write your review here"></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-dark w-100">Submit Now</button>
                                        </div>
                                    </div>
                                </form>
                                <div id="reviewMessage"></div>
                            </div>
                        </div> -->
                    </div>

                    <div class="col-xl-4 col-lg-4">
                        <div class="booking-form p-4 border rounded shadow">
                            <h3 class="mb-4">Your Reservation</h3>
                            <form action="room_detail.php" id="bookingForm" method="post">
                                <input type="hidden" id="room_no" name="room_no" value="<?php echo $room_no; ?>">
                                <div class="mb-3">
                                    <label for="date-in" class="form-label">Check In:</label>
                                    <input type="date" class="form-control" id="date-in" name="check_in">
                                </div>
                                <div class="mb-3">
                                    <label for="date-out" class="form-label">Check Out:</label>
                                    <input type="date" class="form-control" id="date-out" name="check_out">
                                </div>
                                <div class="mb-3">
                                    <label for="guest" class="form-label">Guests:</label>
                                    <select id="guest" name="guests" class="form-select">
                                        <option value="1">1 Adult</option>
                                        <option value="2">2 Adults</option>
                                        <option value="3">3 Adults</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Book Now</button>
                            </form>
                            <div id="bookingMessage"></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Room Details Section End -->
    </div>
    <?php
    include('footer.php');
    ?>


    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {

            // Custom regex method for name validation
            $.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
            }, "Only letters and spaces are allowed");

            $("#reviewForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                        lettersOnly: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    review: {
                        required: true,
                        minlength: 10,
                        maxlength: 500
                    },
                    rating: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Name is required",
                        minlength: "Name must be at least 3 characters",
                        maxlength: "Name cannot exceed 30 characters"
                    },
                    email: {
                        required: "Email is required",
                        email: "Enter a valid email"
                    },
                    review: {
                        required: "Review is required",
                        minlength: "Review must be at least 10 characters",
                        maxlength: "Review cannot exceed 500 characters"
                    },
                    rating: {
                        required: "Please select a rating"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    if (element.prop("tagName") === "SELECT") {
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });

            $("#reviewForm").submit(function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    alert('Review submitted successfully!');
                    this.submit();
                }
            });

            $("#bookingForm").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: window.location.href, // Submit to same page
                    data: $("#bookingForm").serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $("#bookingMessage").html('<div class="alert alert-success">' + response.message + '</div>');
                            $("#bookingForm")[0].reset(); // Clear form
                        } else {
                            $("#bookingMessage").html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    }
                });
            });
        });
    </script>


</body>

</html>