<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle Delete Payment
if (isset($_POST['delete_payment'])) {
    $payment_id = $_POST['payment_id'];
    $deleteQuery = "DELETE FROM payments WHERE payment_id = ?";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_manage_payments.php");
    exit();
}

// Handle Update Payment Status
if (isset($_POST['update_status'])) {
    $payment_id = $_POST['payment_id'];
    $new_status = $_POST['new_status'];
    $updateQuery = "UPDATE payments SET payment_status = ? WHERE payment_id = ?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("si", $new_status, $payment_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_manage_payments.php");
    exit();
}

// Fetch Payments from Database
$query = "SELECT p.payment_id, p.transaction_id, u.fullname, p.amount, p.payment_method, p.payment_status 
          FROM payments p JOIN users u ON p.user_id = u.id";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Payments</title>
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
                                    <h4 class="card-title">Manage Payments</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>User Name</th>
                                                    <th>Amount ($)</th>
                                                    <th>Payment Method</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $result->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo $row['transaction_id']; ?></td>
                                                        <td><?php echo $row['fullname']; ?></td>
                                                        <td><?php echo $row['amount']; ?></td>
                                                        <td><?php echo $row['payment_method']; ?></td>
                                                        <td>
                                                            <label class="badge <?php
                                                                                echo ($row['payment_status'] == 'Completed') ? 'badge-success' : (($row['payment_status'] == 'Pending') ? 'badge-warning' : 'badge-danger');
                                                                                ?>">
                                                                <?php echo $row['payment_status']; ?>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm view-btn"
                                                                data-transaction="<?php echo $row['transaction_id']; ?>"
                                                                data-user="<?php echo $row['fullname']; ?>"
                                                                data-amount="<?php echo $row['amount']; ?>"
                                                                data-method="<?php echo $row['payment_method']; ?>"
                                                                data-status="<?php echo $row['payment_status']; ?>">
                                                                View
                                                            </button>
                                                            <form method="POST" style="display:inline;">
                                                                <input type="hidden" name="payment_id" value="<?php echo $row['payment_id']; ?>">
                                                                <select name="new_status" class="form-control-sm">
                                                                    <option value="Pending" <?php if ($row['payment_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                                                    <option value="Completed" <?php if ($row['payment_status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                                                                    <option value="Failed" <?php if ($row['payment_status'] == 'Failed') echo 'selected'; ?>>Failed</option>
                                                                </select>
                                                                <button type="submit" name="update_status" class="btn btn-success btn-sm">Update</button>
                                                            </form>
                                                            <form method="POST" style="display:inline;">
                                                                <input type="hidden" name="payment_id" value="<?php echo $row['payment_id']; ?>">
                                                                <button type="submit" name="delete_payment" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php if ($result->num_rows == 0) echo "<p>No payments found.</p>"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment View Modal -->
    <div class="overlay" id="paymentModal">
        <div class="popup-card">
            <h4 class="card-title">Payment Details</h4>
            <hr>
            <p><strong>Transaction ID:</strong> <span id="modalTransaction"></span></p>
            <p><strong>User Name:</strong> <span id="modalUser"></span></p>
            <p><strong>Amount:</strong> $<span id="modalAmount"></span></p>
            <p><strong>Payment Method:</strong> <span id="modalMethod"></span></p>
            <p><strong>Status:</strong> <span id="modalStatus"></span></p>
            <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const viewButtons = document.querySelectorAll(".view-btn");
            const paymentModal = document.getElementById("paymentModal");
            const closeModal = document.getElementById("closeModal");

            viewButtons.forEach(button => {
                button.addEventListener("click", () => {
                    document.getElementById("modalTransaction").textContent = button.dataset.transaction;
                    document.getElementById("modalUser").textContent = button.dataset.user;
                    document.getElementById("modalAmount").textContent = button.dataset.amount;
                    document.getElementById("modalMethod").textContent = button.dataset.method;
                    document.getElementById("modalStatus").textContent = button.dataset.status;
                    paymentModal.style.display = "flex";
                });
            });

            closeModal.addEventListener("click", () => {
                paymentModal.style.display = "none";
            });

            paymentModal.addEventListener("click", (e) => {
                if (e.target === paymentModal) {
                    paymentModal.style.display = "none";
                }
            });
        });
    </script>
</body>

</html>