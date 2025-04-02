<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle Delete Bill action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_bill'])) {
    $bill_id = $_POST['bill_id'];

    $delete_query = "DELETE FROM bills WHERE bill_id='$bill_id'";

    if (mysqli_query($con, $delete_query)) {
        header("Location: admin_manage_bills.php?success=Bill Deleted Successfully");
        exit();
    } else {
        header("Location: admin_manage_bills.php?error=Database error: " . mysqli_error($con));
        exit();
    }
}

// Fetch bills with customer name and room number using JOINs.
// Adjust the table and column names as per your schema.
$query = "SELECT b.*, u.fullname AS customer_name, bk.room_no 
          FROM bills b 
          JOIN users u ON b.user_id = u.id 
          JOIN bookings bk ON b.booking_id = bk.booking_id
          ORDER BY b.generated_at DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bills</title>
    <link rel="stylesheet" href="../assets/css/admin_style.css">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Display Success/Error Messages -->
                    <?php if (isset($_GET['success'])) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_GET['success']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error'])) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_GET['error']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Bills</h4>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Bill ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Room Number</th>
                                                    <th>Total Amount ($)</th>
                                                    <th>Payment Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?= $row['bill_id'] ?></td>
                                                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                                                        <td><?= $row['room_no'] ?></td>
                                                        <td><?= number_format($row['amount'], 2) ?></td>
                                                        <td>
                                                            <?php
                                                            $status = $row['payment_status'];
                                                            if ($status == 'Paid') {
                                                                echo '<label class="badge badge-success">Paid</label>';
                                                            } elseif ($status == 'Pending') {
                                                                echo '<label class="badge badge-warning">Pending</label>';
                                                            } elseif ($status == 'Unpaid') {
                                                                echo '<label class="badge badge-danger">Unpaid</label>';
                                                            } else {
                                                                echo '<label class="badge badge-secondary">' . htmlspecialchars($status) . '</label>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <!-- Print Bill Button: Calls the PDF generation script -->
                                                            <a href="generate_bill_pdf.php?bill_id=<?= $row['bill_id'] ?>" target="_blank" class="btn btn-info btn-sm">Print</a>

                                                            <!-- Delete Bill Button -->
                                                            <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this bill?');">
                                                                <input type="hidden" name="bill_id" value="<?= $row['bill_id'] ?>">
                                                                <input type="hidden" name="delete_bill" value="1">
                                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <?php if (mysqli_num_rows($result) == 0) { ?>
                                                    <tr>
                                                        <td colspan="6">No bills found.</td>
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
</body>

</html>