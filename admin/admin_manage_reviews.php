<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>
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
                                    <h4 class="card-title">Manage Reviews</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Review</th>
                                                    <th>Rating</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>John Doe</td>
                                                    <td>Great experience! Loved the service.</td>
                                                    <td>5 ★</td>
                                                    <td>2025-02-01</td>
                                                    <td><label class="badge badge-warning">Pending</label></td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm">Approve</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jane Smith</td>
                                                    <td>Room was clean and comfortable.</td>
                                                    <td>4 ★</td>
                                                    <td>2025-01-29</td>
                                                    <td><label class="badge badge-success">Approved</label></td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Mike Johnson</td>
                                                    <td>Not satisfied with the service.</td>
                                                    <td>2 ★</td>
                                                    <td>2025-01-25</td>
                                                    <td><label class="badge badge-danger">Spam</label></td>
                                                    <td>
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