<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle booking status updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];
    $action = $_POST['action'];

    // Convert action to proper status value - matching your database enum/varchar values exactly
    if ($action == 'confirm') {
        $status = 'confirmed'; // Using lowercase if that's what your database expects
    } else if ($action == 'cancel') {
        $status = 'cancelled'; // Using lowercase if that's what your database expects
    }

    try {
        // Update booking status
        $query = "UPDATE bookings SET status = ? WHERE booking_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("si", $status, $booking_id);

        if ($stmt->execute()) {
            echo "Success";
        } else {
            throw new Exception(mysqli_error($con));
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    exit();
}

// Fetch all bookings
$query = "SELECT * FROM bookings ORDER BY check_in DESC";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error fetching bookings: " . mysqli_error($con));
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
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Manage Bookings</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>Guest Name</th>
                                            <th>Room No</th>
                                            <th>Check-In</th>
                                            <th>Check-Out</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr id="booking_<?php echo $row['booking_id']; ?>">
                                                <td>#<?php echo $row['booking_id']; ?></td>
                                                <td><?php echo htmlspecialchars($row['guest_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['room_no']); ?></td>
                                                <td><?php echo htmlspecialchars($row['check_in']); ?></td>
                                                <td><?php echo htmlspecialchars($row['check_out']); ?></td>
                                                <td>$<?php echo htmlspecialchars($row['total_price']); ?></td>
                                                <td>
                                                    <span class="badge badge-<?php
                                                                                echo (strtolower($row['status']) == 'confirmed') ? 'success' : ((strtolower($row['status']) == 'pending') ? 'warning' : 'danger');
                                                                                ?>">
                                                        <?php echo ucfirst($row['status']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if (strtolower($row['status']) == 'pending') { ?>
                                                        <button class="btn btn-success confirm-btn"
                                                            data-id="<?php echo $row['booking_id']; ?>">
                                                            Confirm
                                                        </button>
                                                    <?php } ?>
                                                    <?php if (strtolower($row['status']) != 'cancelled') { ?>
                                                        <button class="btn btn-danger cancel-btn"
                                                            data-id="<?php echo $row['booking_id']; ?>">
                                                            Cancel
                                                        </button>
                                                    <?php } ?>
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

    <script>
        // Confirm booking
        document.querySelectorAll('.confirm-btn').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to confirm this booking?')) {
                    updateBooking(this.dataset.id, 'confirm');
                }
            });
        });

        // Cancel booking
        document.querySelectorAll('.cancel-btn').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to cancel this booking?')) {
                    updateBooking(this.dataset.id, 'cancel');
                }
            });
        });

        // Function to update booking status
        function updateBooking(bookingId, action) {
            const formData = new FormData();
            formData.append('booking_id', bookingId);
            formData.append('action', action);

            fetch('admin_manage_bookings.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data.includes('Success')) {
                        alert('Booking ' + action + 'ed successfully!');
                        location.reload();
                    } else {
                        alert('Error updating booking: ' + data);
                        console.error('Server response:', data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the booking');
                });
        }
    </script>
</body>

</html>