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
                                                <tr>
                                                    <td>TXN123456</td>
                                                    <td>John Doe</td>
                                                    <td>150.00</td>
                                                    <td>Credit Card</td>
                                                    <td><label class="badge badge-success">Completed</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm view-btn"
                                                            data-transaction="TXN123456"
                                                            data-user="John Doe"
                                                            data-amount="150.00"
                                                            data-method="Credit Card"
                                                            data-status="Completed">
                                                            View
                                                        </button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>TXN654321</td>
                                                    <td>Jane Smith</td>
                                                    <td>200.00</td>
                                                    <td>PayPal</td>
                                                    <td><label class="badge badge-warning">Pending</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm view-btn"
                                                            data-transaction="TXN654321"
                                                            data-user="Jane Smith"
                                                            data-amount="200.00"
                                                            data-method="PayPal"
                                                            data-status="Pending">
                                                            View
                                                        </button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>TXN789012</td>
                                                    <td>Michael Brown</td>
                                                    <td>120.00</td>
                                                    <td>Bank Transfer</td>
                                                    <td><label class="badge badge-danger">Failed</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm view-btn"
                                                            data-transaction="TXN789012"
                                                            data-user="Michael Brown"
                                                            data-amount="120.00"
                                                            data-method="Bank Transfer"
                                                            data-status="Failed">
                                                            View
                                                        </button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
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
            const viewButtons = document.querySelectorAll(".view-btn"); // Fix variable name
            const paymentModal = document.getElementById("paymentModal");
            const closeModal = document.getElementById("closeModal");

            viewButtons.forEach(button => {
                button.addEventListener("click", () => {
                    // Populate modal with data from button attributes
                    document.getElementById("modalTransaction").textContent = button.dataset.transaction;
                    document.getElementById("modalUser").textContent = button.dataset.user;
                    document.getElementById("modalAmount").textContent = button.dataset.amount;
                    document.getElementById("modalMethod").textContent = button.dataset.method;
                    document.getElementById("modalStatus").textContent = button.dataset.status;

                    // Show modal
                    paymentModal.style.display = "flex";
                });
            });

            // Close modal when clicking the "Close" button
            closeModal.addEventListener("click", () => {
                paymentModal.style.display = "none";
            });

            // Close modal when clicking outside the modal content
            paymentModal.addEventListener("click", (e) => {
                if (e.target === paymentModal) {
                    paymentModal.style.display = "none";
                }
            });
        });
    </script>
</body>

</html>