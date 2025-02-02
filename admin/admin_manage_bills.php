<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bills</title>
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
                                                <tr>
                                                    <td>1001</td>
                                                    <td>John Doe</td>
                                                    <td>101</td>
                                                    <td>200</td>
                                                    <td><label class="badge badge-success">Paid</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">View</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1002</td>
                                                    <td>Jane Smith</td>
                                                    <td>102</td>
                                                    <td>350</td>
                                                    <td><label class="badge badge-warning">Pending</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">View</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>1003</td>
                                                    <td>Michael Johnson</td>
                                                    <td>103</td>
                                                    <td>500</td>
                                                    <td><label class="badge badge-danger">Unpaid</label></td>
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