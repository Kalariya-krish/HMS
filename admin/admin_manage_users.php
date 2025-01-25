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
                                    <h4 class="card-title">Manage Users</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profile Picture</th>
                                                    <th>User ID</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Example User 1 -->
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/50" alt="User Image" class="img-fluid rounded-circle"></td>
                                                    <td>#U001</td>
                                                    <td>john_doe</td>
                                                    <td>john@example.com</td>
                                                    <td><label class="badge badge-success">Active</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <!-- Example User 2 -->
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/50" alt="User Image" class="img-fluid rounded-circle"></td>
                                                    <td>#U002</td>
                                                    <td>jane_smith</td>
                                                    <td>jane@example.com</td>
                                                    <td><label class="badge badge-warning">Inactive</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <!-- Example User 3 -->
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/50" alt="User Image" class="img-fluid rounded-circle"></td>
                                                    <td>#U003</td>
                                                    <td>chris_brown</td>
                                                    <td>chris@example.com</td>
                                                    <td><label class="badge badge-success">Active</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <!-- Example User 4 -->
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/50" alt="User Image" class="img-fluid rounded-circle"></td>
                                                    <td>#U004</td>
                                                    <td>emily_white</td>
                                                    <td>emily@example.com</td>
                                                    <td><label class="badge badge-danger">Banned</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
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