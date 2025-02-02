<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired Offers</title>
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
                                    <h4 class="card-title">Expired Offers</h4>
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
                                                    <td><img src="https://via.placeholder.com/50" alt="Offer Image" class="img-fluid rounded"></td>
                                                    <td>Summer Sale</td>
                                                    <td>20%</td>
                                                    <td>2024-06-01</td>
                                                    <td>2024-07-01</td>
                                                    <td>Special summer discount for all rooms.</td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/50" alt="Offer Image" class="img-fluid rounded"></td>
                                                    <td>New Year Discount</td>
                                                    <td>15%</td>
                                                    <td>2023-12-15</td>
                                                    <td>2024-01-05</td>
                                                    <td>Celebrate the new year with great savings!</td>
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