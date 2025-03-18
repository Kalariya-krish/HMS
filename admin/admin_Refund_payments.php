<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle Approve or Reject action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['refund_id']) && isset($_POST['action'])) {
    $refund_id = $_POST['refund_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $update_query = "UPDATE refunds SET status='Approved' WHERE refund_id='$refund_id'";
    } elseif ($action === 'reject') {
        $update_query = "UPDATE refunds SET status='Rejected' WHERE refund_id='$refund_id'";
    }

    if (mysqli_query($con, $update_query)) {
        if ($action === 'approve') {
            header("Location: admin_refund_payments.php?success=Refund Approved Successfully");
        } elseif ($action === 'reject') {
            header("Location: admin_refund_payments.php?success=Refund Rejected Successfully");
        }
        exit();
    } else {
        header("Location: admin_refund_payments.php?error=Database error: " . mysqli_error($con));
        exit();
    }
}

// Fetch all refunds
$query = "SELECT * FROM refunds ORDER BY refund_date DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Refund Payments</title>
    <link rel="stylesheet" href="../assets/css/admin_style.css">
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
                                    <h4 class="card-title">Manage Refund Payments</h4>

                                    <!-- Show success or error message -->
                                    <?php if (isset($_GET['success']) || isset($_GET['error'])) { ?>
                                        <div id="alert-box" class="alert 
        <?= isset($_GET['success']) ? 'alert-success' : 'alert-danger' ?>"
                                            role="alert">
                                            <?= isset($_GET['success']) ? $_GET['success'] : $_GET['error'] ?>
                                        </div>
                                        <script>
                                            setTimeout(() => {
                                                document.getElementById('alert-box').style.display = 'none';
                                            }, 5000); // Hide after 5 seconds
                                        </script>
                                    <?php } ?>


                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Refund ID</th>
                                                    <th>Booking ID</th>
                                                    <th>Guest Name</th>
                                                    <th>Amount ($)</th>
                                                    <th>Refund Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?= $row['refund_id'] ?></td>
                                                        <td><?= $row['booking_id'] ?></td>
                                                        <td><?= $row['guest_name'] ?></td>
                                                        <td><?= $row['amount'] ?></td>
                                                        <td><?= $row['refund_date'] ?></td>
                                                        <td>
                                                            <?php if ($row['status'] == 'Pending') { ?>
                                                                <label class="badge badge-warning">Pending</label>
                                                            <?php } elseif ($row['status'] == 'Approved') { ?>
                                                                <label class="badge badge-success">Approved</label>
                                                            <?php } else { ?>
                                                                <label class="badge badge-danger">Rejected</label>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($row['status'] == 'Pending') { ?>
                                                                <form method="post" style="display:inline-block;">
                                                                    <input type="hidden" name="refund_id" value="<?= $row['refund_id'] ?>">
                                                                    <input type="hidden" name="action" value="approve">
                                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                                </form>
                                                                <form method="post" style="display:inline-block;">
                                                                    <input type="hidden" name="refund_id" value="<?= $row['refund_id'] ?>">
                                                                    <input type="hidden" name="action" value="reject">
                                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                                </form>
                                                            <?php } else { ?>
                                                                <button class="btn btn-secondary btn-sm" disabled><?= $row['status'] ?></button>
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
        </div>
    </div>
</body>

</html>