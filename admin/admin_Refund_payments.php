<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Refund Payments</title>
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
                                                <tr>
                                                    <td>R001</td>
                                                    <td>B101</td>
                                                    <td>John Doe</td>
                                                    <td>100</td>
                                                    <td>2025-02-01</td>
                                                    <td><label class="badge badge-warning">Pending</label></td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm">Approve</button>
                                                        <button class="btn btn-danger btn-sm">Reject</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>R002</td>
                                                    <td>B102</td>
                                                    <td>Jane Smith</td>
                                                    <td>150</td>
                                                    <td>2025-02-02</td>
                                                    <td><label class="badge badge-success">Approved</label></td>
                                                    <td>
                                                        <button class="btn btn-secondary btn-sm" disabled>Approved</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>R003</td>
                                                    <td>B103</td>
                                                    <td>Michael Brown</td>
                                                    <td>200</td>
                                                    <td>2025-02-03</td>
                                                    <td><label class="badge badge-danger">Rejected</label></td>
                                                    <td>
                                                        <button class="btn btn-secondary btn-sm" disabled>Rejected</button>
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