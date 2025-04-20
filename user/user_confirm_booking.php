<?php
// confirm_booking.php
require('../vendor/autoload.php');

use Razorpay\Api\Api;

include_once('../db_connection.php');
include_once('../auth_check.php');

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

$api = new Api('rzp_test_gKgQuJWNMwZxDg', 'qgZhV2DJb72rjR0Qc7b1lzDB');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['razorpay_payment_id'])) {
    $paymentId = $_POST['razorpay_payment_id'];
    $roomNo = $_POST['room_no'];
    $guestName = $_POST['guest_name'];
    $guestPhone = $_POST['guest_phone'];
    $guestAddress = $_POST['guest_address'];
    $checkIn = $_POST['check_in'];
    $checkOut = $_POST['check_out'];
    $amount = $_POST['amount'];

    try {
        $payment = $api->payment->fetch($paymentId);
        if ($payment->status == 'captured') {
            $email = $_SESSION['email'];

            // Insert into bookings
            $booking_sql = "INSERT INTO bookings (email, room_no, guest_name, guest_phone, guest_address, check_in, check_out, amount, payment_id, status)
                            VALUES ('$email', '$roomNo', '$guestName', '$guestPhone', '$guestAddress', '$checkIn', '$checkOut', '$amount', '$paymentId', 'Confirmed')";
            mysqli_query($con, $booking_sql);

            // Insert into payments table (optional but useful)
            $payment_sql = "INSERT INTO payments (payment_id, email, amount, payment_status, created_at)
                            VALUES ('$paymentId', '$email', '$amount', 'captured', NOW())";
            mysqli_query($con, $payment_sql);

            // Update room status
            mysqli_query($con, "UPDATE rooms SET room_status='Booked' WHERE room_no = '$roomNo'");

            echo "success";
            exit;
        } else {
            echo "Payment not captured.";
            exit;
        }
    } catch (\Exception $e) {
        echo "Payment verification failed.";
        exit;
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
    <?php include_once('user_header.php'); ?>

    <div class="container py-5">
        <div class="page-title text-center mb-4">
            <p class="overlay-text h2">Confirm Booking</p>
        </div><br><br>

        <div class="row">
            <!-- Room Details Column -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="../assets/images/rooms/<?php echo $room['image']; ?>" class="card-img-top" alt="Room Image" style="height:100%; object-fit:cover;">
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
                    <div id="bookingMessage" class="mb-3"></div>
                    <form action="user_confirm_booking.php" method="post" id="form">
                        <input type="hidden" name="room_no" value="<?php echo $room['room_no']; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="guest_name">Name</label>
                                <input type="text" class="form-control" id="guest_name" name="guest_name" value="<?php echo $user_name; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="guest_phone">Phone</label>
                                <input type="tel" class="form-control" id="guest_phone" name="guest_phone" value="<?php echo $user_phone; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="guest_address">Address</label>
                                <textarea class="form-control" id="guest_address" name="guest_address" rows="2"><?php echo $user_address; ?></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="check_in">Check-in</label>
                                <input type="date" class="form-control" id="check_in" name="check_in" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="check_out">Check-out</label>
                                <input type="date" class="form-control" id="check_out" name="check_out">
                            </div>
                        </div>
                        <div id="totalAmountContainer" class="alert alert-info text-center d-none">
                            <strong>No. of days</strong> <span id="numDays">0</span><br>
                            <strong>Total Amount:</strong> <span id="totalAmountText">0</span> Rs.
                        </div>
                        <button type="button" id="rzp-button" class="btn btn-primary btn-block mt-3">Pay Now</button>
                        <input type="hidden" id="bookingAmount" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('user_footer.php'); ?>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Set min date for check-in to today
        const today = new Date().toISOString().split('T')[0];
        $('#check_in').attr('min', today);

        // Set check-out date to only be selectable after check-in
        $('#check_in').change(function() {
            let checkInDate = $(this).val();
            $('#check_out').attr('min', checkInDate);
        });

        // Add custom validator for check-out > check-in
        $.validator.addMethod("greaterThan", function(value, element, param) {
            const checkIn = new Date($(param).val());
            const checkOut = new Date(value);
            return checkOut > checkIn;
        }, "Check-out must be after check-in.");

        // Validation
        $("#form").validate({
            rules: {
                guest_name: {
                    required: true,
                    minlength: 3
                },
                guest_phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 15
                },
                guest_address: {
                    required: true,
                    minlength: 5
                },
                check_in: {
                    required: true,
                    date: true
                },
                check_out: {
                    required: true,
                    date: true,
                    greaterThan: "#check_in"
                }
            },
            messages: {
                guest_name: {
                    required: "Please enter your name",
                    minlength: "Name must be at least 3 characters"
                },
                guest_phone: {
                    required: "Please enter your phone number",
                    digits: "Phone must be digits only",
                    minlength: "Phone number must be at least 10 digits",
                    maxlength: "Phone number is too long"
                },
                guest_address: {
                    required: "Please enter your address",
                    minlength: "Address must be at least 5 characters"
                },
                check_in: {
                    required: "Please select a check-in date",
                    date: "Enter a valid date"
                },
                check_out: {
                    required: "Please select a check-out date",
                    date: "Enter a valid date",
                    greaterThan: "Check-out date must be after check-in date"
                },
                guests: {
                    required: "Please select the number of guests"
                }
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                error.insertAfter(element);
            },
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            }
        });

        // calculate total price
        const checkInInput = document.getElementById('check_in');
        const checkOutInput = document.getElementById('check_out');
        const numDaysDisplay = document.getElementById('numDays');
        const totalAmountText = document.getElementById('totalAmountText');
        const totalAmountContainer = document.getElementById('totalAmountContainer');

        const pricePerNight = <?php echo (int)$room['price']; ?>;

        function calculateBookingDetails() {
            const checkIn = new Date(checkInInput.value);
            const checkOut = new Date(checkOutInput.value);

            if (!isNaN(checkIn.getTime()) && !isNaN(checkOut.getTime())) {
                const diffTime = checkOut - checkIn;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays > 0) {
                    numDaysDisplay.textContent = diffDays;
                    totalAmountText.textContent = diffDays * pricePerNight;
                    totalAmountContainer.classList.remove('d-none');
                } else {
                    totalAmountContainer.classList.add('d-none');
                }
            } else {
                totalAmountContainer.classList.add('d-none');
            }
        }

        checkInInput.addEventListener('change', calculateBookingDetails);
        checkOutInput.addEventListener('change', calculateBookingDetails);
    </script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById("rzp-button").onclick = function(e) {
            e.preventDefault();

            const checkIn = checkInInput.value;
            const checkOut = checkOutInput.value;
            const guestName = document.getElementById("guest_name").value;
            const guestPhone = document.getElementById("guest_phone").value;
            const guestAddress = document.getElementById("guest_address").value;

            if (!$('#form').valid()) return;

            // Get amount
            const days = parseInt(document.getElementById('numDays').textContent);
            const amount = days * pricePerNight;

            $.post("create_order.php", {
                amount: amount
            }, function(order) {
                const options = {
                    "key": "rzp_test_gKgQuJWNMwZxDg", // Replace with your public key
                    "amount": amount * 100,
                    "currency": "INR",
                    "name": "Hotel Booking",
                    "description": "Room Booking Payment",
                    "order_id": order.id,
                    "handler": function(response) {
                        // On payment success, send data to server
                        $.post("user_confirm_booking.php", {
                            razorpay_payment_id: response.razorpay_payment_id,
                            room_no: <?php echo $room['room_no']; ?>,
                            guest_name: guestName,
                            guest_phone: guestPhone,
                            guest_address: guestAddress,
                            check_in: checkIn,
                            check_out: checkOut,
                            amount: amount
                        }, function(res) {
                            alert("Booking confirmed!");
                            window.location.href = "user_my_bookings.php";
                        });
                    },
                    "theme": {
                        "color": "#fca311"
                    }
                };
                const rzp1 = new Razorpay(options);
                rzp1.open();
            }, 'json');
        };
    </script>

</body>

</html>