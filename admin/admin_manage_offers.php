<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Offers</title>
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
                                    <h4 class="card-title">Manage Offers</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Offer Title</th>
                                                    <th>Discount (%)</th>
                                                    <th>Valid From</th>
                                                    <th>Valid Until</th>
                                                    <th>Description</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Offer Image" class="img-fluid rounded">
                                                    </td>
                                                    <td>Summer Special</td>
                                                    <td>20%</td>
                                                    <td>2025-06-01</td>
                                                    <td>2025-08-31</td>
                                                    <td>Get 20% off on all rooms during summer.</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Offer Image" class="img-fluid rounded">
                                                    </td>
                                                    <td>Weekend Deal</td>
                                                    <td>15%</td>
                                                    <td>2025-02-01</td>
                                                    <td>2025-02-28</td>
                                                    <td>Special weekend discounts on deluxe rooms.</td>
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