<?php
include '../db_connection.php';

// Fetch booking data
$query = "SELECT * FROM bookings";
$result = mysqli_query($con, $query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];

    $query = "DELETE FROM bookings WHERE booking_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        echo "Booking deleted successfully!";
    } else {
        echo "Error deleting booking.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="../assets/css/admin_editform_style.css">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Bookings</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Booking ID</th>
                                                    <th>Guest Name</th>
                                                    <th>Room Number</th>
                                                    <th>Check-In</th>
                                                    <th>Check-Out</th>
                                                    <th>Total Amount ($)</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr id="booking_<?php echo $row['booking_id']; ?>">
                                                        <td>#B<?php echo $row['booking_id']; ?></td>
                                                        <td><?php echo $row['guest_name']; ?></td>
                                                        <td><?php echo $row['room_no']; ?></td>
                                                        <td><?php echo $row['check_in']; ?></td>
                                                        <td><?php echo $row['check_out']; ?></td>
                                                        <td><?php echo $row['total_price']; ?></td>
                                                        <td>
                                                            <label class="badge badge-<?php echo ($row['status'] == 'Confirmed') ? 'success' : (($row['status'] == 'Pending') ? 'warning' : 'danger'); ?>">
                                                                <?php echo $row['status']; ?>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm confirm-btn" data-id="<?php echo $row['booking_id']; ?>">Confirm</button>
                                                            <button class="btn btn-danger btn-sm cancel-btn" data-id="<?php echo $row['booking_id']; ?>">Cancel</button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on("click", ".confirm-btn", function() {
            let bookingId = $(this).data("id");
            $.post("update_booking.php", {
                booking_id: bookingId,
                status: "Confirmed"
            }, function(response) {
                alert(response);
                location.reload();
            });
        });

        $(document).on("click", ".cancel-btn", function() {
            let bookingId = $(this).data("id");
            if (confirm("Are you sure you want to cancel this booking?")) {
                $.post("update_booking.php", {
                    booking_id: bookingId,
                    status: "Cancelled"
                }, function(response) {
                    alert(response);
                    location.reload();
                });
            }
        });
    </script>
</body>

</html>