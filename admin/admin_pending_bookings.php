<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                                                <tr>
                                                    <td>#B002</td>
                                                    <td>Jane Smith</td>
                                                    <td>102</td>
                                                    <td>2025-01-12</td>
                                                    <td>2025-01-18</td>
                                                    <td>480</td>
                                                    <td><label class="badge badge-warning">Pending</label></td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm">Confirm</button>
                                                        <button class="btn btn-danger btn-sm">Cancel</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>#B005</td>
                                                    <td>Chris Brown</td>
                                                    <td>105</td>
                                                    <td>2025-01-18</td>
                                                    <td>2025-01-23</td>
                                                    <td>250</td>
                                                    <td><label class="badge badge-warning">Pending</label></td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm">Confirm</button>
                                                        <button class="btn btn-danger btn-sm">Cancel</button>
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