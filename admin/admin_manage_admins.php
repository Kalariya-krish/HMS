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
                                    <h4 class="card-title">Manage Admins</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profile Picture</th>
                                                    <th>Admin Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Profile Picture" class="img-fluid rounded-circle">
                                                    </td>
                                                    <td>John Doe</td>
                                                    <td>john.doe@example.com</td>
                                                    <td><label class="badge badge-success">Active</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Profile Picture" class="img-fluid rounded-circle">
                                                    </td>
                                                    <td>Jane Smith</td>
                                                    <td>jane.smith@example.com</td>
                                                    <td><label class="badge badge-warning">Inactive</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Profile Picture" class="img-fluid rounded-circle">
                                                    </td>
                                                    <td>Robert Brown</td>
                                                    <td>robert.brown@example.com</td>
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