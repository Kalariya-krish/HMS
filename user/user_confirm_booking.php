<?php
// Start output buffering
ob_start();



// Strict error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../vendor/razorpay/razorpay/Razorpay.php'); // Include Razorpay SDK
use Razorpay\Api\Api;

include_once('../db_connection.php');
include_once('../auth_check.php');

// Get and sanitize the room number from query string
$room_no = isset($_GET['room_no']) ? intval($_GET['room_no']) : 0;
if ($room_no <= 0) {
    header('Location: user_rooms.php');
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
// $_SESSION['room_no']=$user['room_no'];

// Fetch logged-in user details via session email
$user_name = '';
$user_phone = '';
$user_address = '';
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql_user = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $res_user = mysqli_query($con, $sql_user);
    if ($res_user && mysqli_num_rows($res_user) === 1) {
        $user = mysqli_fetch_assoc($res_user);
        $user_name = $user['fullname'];
        $user_phone = $user['mobile_no'];
        $user_address = $user['address'];
        $_SESSION['user_id'] = $user['id'];
        // $_SESSION['email']=$email;
        // $_SESSION['fullname']=$user['fullname'];
        // $_SESSION['mobile_no']=$user['mobile_no'];
        // $_SESSION['address']=$user['address'];
    }
}

// Get the correct price for the current room
$room_price = $room['discounted_price'] > 0 ? $room['discounted_price'] : $room['price'];
$_SESSION['room_price'] = $room_price;
$_SESSION['current_room_no'] = $room_no;

// Reset discount and total when viewing a different room
if (!isset($_SESSION['last_viewed_room']) || $_SESSION['last_viewed_room'] != $room_no) {
    $_SESSION['discount'] = 0;
    $_SESSION['total'] = $room_price;
    unset($_SESSION['offer']);
    unset($_SESSION['offer_code']);
    unset($_SESSION['offer_status']);
    unset($_SESSION['status']);
    unset($_SESSION['discount_percentage']);
    $_SESSION['last_viewed_room'] = $room_no;
}

// Initialize Razorpay API
$api = new Api('rzp_test_gKgQuJWNMwZxDg', 'qgZhV2DJb72rjR0Qc7b1lzDB');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['razorpay_payment_id'])) {
    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $paymentId = $_POST['razorpay_payment_id'];
    $order_id = 'ORDER_' . uniqid();
    $roomNo = $_POST['room_no'];
    $guestName = $_POST['guest_name'];
    $guestPhone = $_POST['guest_phone'];
    $guestAddress = $_POST['guest_address'];
    $checkIn = $_POST['check_in'];
    $checkOut = $_POST['check_out'];
    $amount = $_POST['amount'];

    try {
        // Verify payment with Razorpay
        $payment = $api->payment->fetch($paymentId);

        if ($payment->status == 'captured') {
            $email = $_SESSION['email'];

            // Insert into bookings - with error checking
            $booking_sql = "INSERT INTO bookings (email, user_id, room_no, fullname, mobile_no, address, check_in, check_out, amount, payment_id, status)
    VALUES ('$email', $user_id, '$roomNo', '$guestName', '$guestPhone', '$guestAddress', '$checkIn', '$checkOut', '$amount', '$paymentId', 'Confirmed')";

            if (!mysqli_query($con, $booking_sql)) {
                throw new Exception("Booking failed: " . mysqli_error($con));
            }

            // Fix this line in your PHP code:
            $payment_sql = "INSERT INTO payments (payment_id, order_id, email, amount, status, created_at)
    VALUES ('$paymentId', '$order_id', '$email', '$amount', 'captured', NOW())";
            if (!mysqli_query($con, $payment_sql)) {
                throw new Exception("Payment record failed: " . mysqli_error($con));
            }

            // Update room status - with error checking
            if (!mysqli_query($con, "UPDATE rooms SET room_status='Booked' WHERE room_no = '$roomNo'")) {
                throw new Exception("Room update failed: " . mysqli_error($con));
            }

            // Clear output buffer to ensure only "success" is returned
            ob_clean();
            echo "success";
            exit;
        } else {
            throw new Exception("Payment not captured. Status: " . $payment->status);
        }
    } catch (\Exception $e) {
        // Clear output buffer to ensure only error message is returned
        ob_clean();
        echo "Payment verification failed: " . $e->getMessage();
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
    <style>
        .price-section,
        .price-section del,
        .price-section span,
        .price-section h3,
        .table.table-sm,
        .table.table-sm td {
            font-family: 'Arial', sans-serif;
        }

        #offer_feedback.success {
            color: #28a745;
        }

        #offer_feedback.danger {
            color: #dc3545;
        }

        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-left: 10px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
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
                        <?php if ($room['discount'] > 0): ?>
                            <div class="price-section">
                                <del class="text-danger"><?php echo $room['price']; ?> Rs.</del>
                                <span class="badge text-white" style="background-color: #0B032D;"><?php echo $room['discount']; ?>% Off</span>
                                <h3><?php echo $room['discounted_price']; ?> Rs.<span>/Per Night</span></h3>
                            </div>
                        <?php else: ?>
                            <h3><?php echo $room['price']; ?> Rs.<span>/Per Night</span></h3>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <form id="offerForm" method="post" class="my-2 w-100">
                        <input type="hidden" name="room_no" value="<?php echo $room_no; ?>">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-md-start">
                                <label for="offercode" class="form-label fw-semibold">Offer Code:</label>
                            </div>
                            <div class="col-md-5 text-md-start">
                                <input type="text" id="offercode" name="offercode" value="<?php echo isset($_SESSION['offer_code']) ? $_SESSION['offer_code'] : ''; ?>" class="form-control">
                            </div>
                            <div class="col-md-3 text-md-start">
                                <button type="submit" class="btn btn-outline-danger w-100" name="apply-offer" id="offerSubmitBtn">
                                    Apply
                                    <span class="loading-spinner" id="offerSpinner"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="offer_feedback" class="mt-2 <?php echo isset($_SESSION['status']) ? $_SESSION['status'] : ''; ?>">
                    <?php echo isset($_SESSION['offer_status']) ? $_SESSION['offer_status'] : ''; ?>
                    <?php if (isset($_SESSION['discount_percentage']) && $_SESSION['discount_percentage'] > 0): ?>
                        <div class="mt-1">Applied <?php echo $_SESSION['discount_percentage']; ?>% discount</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Booking Form Column -->
            <div class="col-md-6">
                <div class="card p-4" style="height:100%;">
                    <h5 class="mb-4">Your Details</h5>
                    <div id="bookingMessage" class="mb-3"></div>
                    <form action="user_confirm_booking.php" method="post" id="bookingForm">
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
                        <br><br>

                        <div class="col-md-12">
                            <div class="card checkout-card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Price Summary</h5>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span>No of Days</span>
                                        <span id="numDays">0</span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Price Per Night</span>
                                        <span>Rs. <?php echo $room_price; ?></span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Subtotal</span>
                                        <span id="totalAmountText">0</span>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Discount (<?php echo isset($_SESSION['discount_percentage']) ? $_SESSION['discount_percentage'] : '0'; ?>%)</span>
                                        <span class="text-success" id="displayDiscount">Rs. 0</span>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between mb-4">
                                        <strong>Final Total</strong>
                                        <strong class="text-danger" id="displayTotal">Rs. <?php echo isset($_SESSION['total']) ? $_SESSION['total'] : $room_price; ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="rzp-button" class="btn btn-primary btn-block mt-3">Pay Now</button>
                        <input type="hidden" id="bookingAmount" name="booking_amount" value="<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : $room_price; ?>">
                        <input type="hidden" id="appliedDiscount" name="applied_discount" value="<?php echo isset($_SESSION['discount']) ? $_SESSION['discount'] : '0'; ?>">
                        <input type="hidden" id="roomPricePerNight" name="room_price_per_night" value="<?php echo $room_price; ?>">
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
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        $(document).ready(function() {

            $("#rzp-button").click(function(e) {
                e.preventDefault();

                // Validate form first
                if (!$("#bookingForm").valid()) {
                    return false;
                }

                // Get form values
                const roomNo = "<?php echo $room['room_no']; ?>";
                const guestName = $("#guest_name").val();
                const guestPhone = $("#guest_phone").val();
                const guestAddress = $("#guest_address").val();
                const checkIn = $("#check_in").val();
                const checkOut = $("#check_out").val();
                const amount = parseFloat($("#bookingAmount").val()) * 100; // Convert to paise

                // Check if amount is valid
                if (isNaN(amount)) {
                    alert("Invalid amount. Please check your booking details.");
                    return false;
                }

                // Create options for Razorpay
                const options = {
                    "key": "rzp_test_gKgQuJWNMwZxDg", // Replace with your actual Razorpay key
                    "amount": amount,
                    "currency": "INR",
                    "name": "Hotel Booking",
                    "description": "Booking for Room " + roomNo,
                    "image": "", // Add your logo if you want
                    "order_id": "", // You'll need to create an order first
                    handler: function(response) {
                        // On successful payment
                        $.ajax({
                            type: 'POST',
                            url: 'user_confirm_booking.php?room_no=<?php echo $room_no; ?>',
                            data: $(this).serialize(),
                            dataType: 'json',
                            success: function(response) {
                                // Handle response
                            },
                            error: function(xhr) {
                                try {
                                    // Try to parse the response anyway
                                    const response = JSON.parse(xhr.responseText);
                                    $('#offer_feedback').text(response.message || 'Error processing offer')
                                        .removeClass('success danger')
                                        .addClass(response.status || 'danger');
                                } catch (e) {
                                    // If not JSON, show raw error
                                    $('#offer_feedback').text('Error: ' + xhr.responseText)
                                        .removeClass('success danger')
                                        .addClass('danger');
                                }
                            }
                        });
                    },
                    "prefill": {
                        "name": guestName,
                        "email": "<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>",
                        "contact": guestPhone
                    },
                    "theme": {
                        "color": "#F37254"
                    }
                };

                // First create an order on your server
                $.ajax({
                    url: "create_order.php",
                    type: "POST",
                    data: {
                        amount: (amount / 100)
                    }, // in rupees
                    success: function(order) {
                        options.order_id = order.id;
                        const rzp1 = new Razorpay(options);
                        rzp1.open();
                    },
                    error: function(xhr, status, error) {
                        alert("Error creating payment order: " + error);
                    }
                });
            });

            // Set min date for check-in to today
            const today = new Date().toISOString().split('T')[0];
            $('#check_in').attr('min', today);

            // Set check-out date to only be selectable after check-in
            $('#check_in').change(function() {
                let checkInDate = $(this).val();
                $('#check_out').attr('min', checkInDate);
                calculateBookingDetails();
            });

            // Add custom validator for check-out > check-in
            $.validator.addMethod("greaterThan", function(value, element, param) {
                const checkIn = new Date($(param).val());
                const checkOut = new Date(value);
                return checkOut > checkIn;
            }, "Check-out must be after check-in.");

            // Validation
            $("#bookingForm").validate({
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

            // Handle offer form submission
            // Modify your offer form submission to include total price
            $("#offerForm").submit(function(e) {
                e.preventDefault();

                const offerCode = $("#offercode").val();
                const roomNo = "<?php echo $room_no; ?>";
                const roomPrice = parseFloat("<?php echo $room_price; ?>");

                // Calculate current total based on dates if available
                let totalPrice = roomPrice;
                if ($("#check_in").val() && $("#check_out").val()) {
                    const checkIn = new Date($('#check_in').val());
                    const checkOut = new Date($('#check_out').val());
                    const diffDays = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
                    totalPrice = diffDays * roomPrice;
                }

                $.ajax({
                    type: 'POST',
                    url: 'apply_offer.php',
                    data: {
                        offercode: offerCode,
                        room_no: roomNo,
                        room_price: roomPrice,
                        total_price: totalPrice // Send the calculated total
                    },
                    // ... rest of your AJAX code ...
                });
            });

            // Calculate total price
            function calculateBookingDetails() {
                const checkIn = new Date($('#check_in').val());
                const checkOut = new Date($('#check_out').val());
                const pricePerNight = parseFloat($('#roomPricePerNight').val());

                if (!isNaN(checkIn.getTime()) && !isNaN(checkOut.getTime())) {
                    const diffTime = checkOut - checkIn;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    if (diffDays > 0) {
                        $('#numDays').text(diffDays);

                        // Calculate total price for all nights
                        const totalPrice = diffDays * pricePerNight;
                        $('#totalAmountText').text('Rs. ' + totalPrice.toFixed(2));

                        // Get discount from session (if any)
                        const discountPercentage = parseFloat("<?php echo isset($_SESSION['discount_percentage']) ? $_SESSION['discount_percentage'] : 0; ?>") / 100;

                        // Calculate discount based on total price
                        const totalDiscount = totalPrice * discountPercentage;
                        $('#displayDiscount').text('Rs. ' + totalDiscount.toFixed(2));

                        // Calculate final total
                        const finalTotal = totalPrice - totalDiscount;
                        $('#displayTotal').text('Rs. ' + finalTotal.toFixed(2));

                        // Update hidden fields
                        $('#bookingAmount').val(finalTotal.toFixed(2));
                        $('#appliedDiscount').val(totalDiscount.toFixed(2));
                    }
                }
            }

            $('#check_out').change(function() {
                calculateBookingDetails();
            });


        });
    </script>
</body>

</html>