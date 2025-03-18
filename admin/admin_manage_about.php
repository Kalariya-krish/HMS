<?php 
include_once('../db_connection.php');
include_once('../auth_check.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage About Us</title>
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
                                    <h4 class="card-title">Manage About Us Content</h4>
                                    <form action="update_about.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>About Us Content</label>
                                            <textarea class="form-control" name="about_content" rows="5" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Image</label>
                                            <input type="file" class="form-control" name="about_image" accept="image/*" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Content</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h4 class="card-title">Existing About Us Content</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Content</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch about us content from database
                                        // include 'db_connect.php';
                                        // $query = "SELECT * FROM about_us";
                                        // $result = mysqli_query($conn, $query);
                                        // while ($row = mysqli_fetch_assoc($result)) {
                                        // 
                                        ?>
                                        <!-- // <tr>
                                            // <td><img src="uploads/<?php echo $row['image']; ?>" width="100"></td>
                                            // <td><?php echo $row['content']; ?></td>
                                            // <td>
                                                // <a href="edit_about.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                // <a href="delete_about.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                // </td>
                                            // </tr> -->
                                        <?php
                                        // } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>