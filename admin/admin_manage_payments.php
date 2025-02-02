<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Payments</title>
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
                                                        <button class="btn btn-info btn-sm">View</button>
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
                                                        <button class="btn btn-info btn-sm">View</button>
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
                                                        <button class="btn btn-info btn-sm">View</button>
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
</body>

</html>