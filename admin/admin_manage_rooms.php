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
                                    <h4 class="card-title">Manage Rooms</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Room Number</th>
                                                    <th>Room Type</th>
                                                    <th>Price ($)</th>
                                                    <th>No. of Beds</th>
                                                    <th>Features</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Room Image" class="img-fluid rounded">
                                                    </td>
                                                    <td>101</td>
                                                    <td>Single</td>
                                                    <td>50</td>
                                                    <td>1</td>
                                                    <td>WiFi, TV</td>
                                                    <td><label class="badge badge-success">Available</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Room Image" class="img-fluid rounded">
                                                    </td>
                                                    <td>102</td>
                                                    <td>Double</td>
                                                    <td>80</td>
                                                    <td>2</td>
                                                    <td>WiFi, TV, AC</td>
                                                    <td><label class="badge badge-warning">Occupied</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Room Image" class="img-fluid rounded">
                                                    </td>
                                                    <td>103</td>
                                                    <td>Suite</td>
                                                    <td>120</td>
                                                    <td>3</td>
                                                    <td>WiFi, TV, AC, Kitchenette</td>
                                                    <td><label class="badge badge-danger">Under Maintenance</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Room Image" class="img-fluid rounded">
                                                    </td>
                                                    <td>104</td>
                                                    <td>Deluxe</td>
                                                    <td>150</td>
                                                    <td>2</td>
                                                    <td>WiFi, TV, AC, Balcony</td>
                                                    <td><label class="badge badge-success">Available</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Room Image" class="img-fluid rounded">
                                                    </td>
                                                    <td>105</td>
                                                    <td>Single</td>
                                                    <td>50</td>
                                                    <td>1</td>
                                                    <td>WiFi</td>
                                                    <td><label class="badge badge-warning">Occupied</label></td>
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
</body>

</html>