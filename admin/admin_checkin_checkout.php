<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle Check-In and Check-Out actions
if (isset($_POST['action']) && isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];

    if ($_POST['action'] == 'checkin') {
        $status = 'Checked-In';
    } elseif ($_POST['action'] == 'checkout') {
        $status = 'Checked-Out';
    }

    // Update check-in status in database
    $updateQuery = "UPDATE bookings SET checkin_status = ? WHERE booking_id = ?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("si", $status, $booking_id);
    $stmt->execute();
    $stmt->close();

    // Reload the page to reflect changes
    header("Location: admin_checkin_checkout.php");
    exit();
}

// Fetch bookings eligible for check-in or check-out
$query = "SELECT * FROM bookings WHERE status = 'Confirmed' AND checkin_status != 'Checked-Out'";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-In & Check-Out</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include Bootstrap or custom CSS -->
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
                                    <h4 class="card-title">Guest Check-In & Check-Out</h4>
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
                                                    <th>Check-In Status</th>
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
                                                        <td>
                                                            <label class="badge badge-info">
                                                                <?php echo $row['checkin_status']; ?>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <?php if ($row['checkin_status'] == 'Not Checked-In') { ?>
                                                                <form method="POST" style="display:inline;">
                                                                    <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                                                                    <button type="submit" name="action" value="checkin" class="btn btn-primary btn-sm">Check-In</button>
                                                                </form>
                                                            <?php } elseif ($row['checkin_status'] == 'Checked-In') { ?>
                                                                <form method="POST" style="display:inline;">
                                                                    <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                                                                    <button type="submit" name="action" value="checkout" class="btn btn-danger btn-sm">Check-Out</button>
                                                                </form>
                                                            <?php } else { ?>
                                                                <button class="btn btn-secondary btn-sm" disabled>Checked-Out</button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php if ($result->num_rows == 0) echo "<p>No bookings available for check-in/check-out.</p>"; ?>
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