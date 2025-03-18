<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle Confirm and Cancel actions
if (isset($_POST['action']) && isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];
    $status = $_POST['action'] == 'confirm' ? 'Confirmed' : 'Cancelled';

    // Update booking status
    $updateQuery = "UPDATE bookings SET status = ? WHERE booking_id = ?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("si", $status, $booking_id);
    $stmt->execute();
    $stmt->close();

    // Reload the page to reflect changes
    header("Location: admin_pending_bookings.php");
    exit();
}

// Fetch pending bookings
$query = "SELECT * FROM bookings WHERE status = 'Pending'";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Bookings</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add Bootstrap or custom CSS -->
</head>

<body>
    <div class="container-scroller">
        <!-- Sidebar -->
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
            <!-- Main Panel -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Pending Bookings</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Booking ID</th>
                                                    <th>Guest Name</th>
                                                    <th>Room Number</th>
                                                    <th>Check-In Date</th>
                                                    <th>Check-Out Date</th>
                                                    <th>Total Amount ($)</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $result->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td>#<?php echo $row['booking_id']; ?></td>
                                                        <td><?php echo $row['guest_name']; ?></td>
                                                        <td><?php echo $row['room_no']; ?></td>
                                                        <td><?php echo $row['check_in']; ?></td>
                                                        <td><?php echo $row['check_out']; ?></td>
                                                        <td><?php echo $row['total_price']; ?></td>
                                                        <td><label class="badge badge-warning"><?php echo $row['status']; ?></label></td>
                                                        <td>
                                                            <form method="POST" style="display:inline;">
                                                                <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                                                                <button type="submit" name="action" value="confirm" class="btn btn-success btn-sm">Confirm</button>
                                                            </form>
                                                            <form method="POST" style="display:inline;">
                                                                <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                                                                <button type="submit" name="action" value="cancel" class="btn btn-danger btn-sm">Cancel</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php if ($result->num_rows == 0) echo "<p>No pending bookings.</p>"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>