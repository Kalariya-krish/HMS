<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle delete review action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_review'])) {
    $review_id = $_POST['review_id'];

    // Delete the review from the database
    $delete_query = "DELETE FROM reviews WHERE review_id='$review_id'";

    if (mysqli_query($con, $delete_query)) {
        header("Location: admin_manage_reviews.php?success=Review Deleted Successfully");
        exit();
    } else {
        header("Location: admin_manage_reviews.php?error=Database error: " . mysqli_error($con));
        exit();
    }
}

// Handle approve review action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approve_review'])) {
    $review_id = $_POST['review_id'];

    // Update the review status to 'Approved'
    $update_query = "UPDATE reviews SET status='Approved' WHERE review_id='$review_id'";

    if (mysqli_query($con, $update_query)) {
        header("Location: admin_manage_reviews.php?success=Review Approved Successfully");
        exit();
    } else {
        header("Location: admin_manage_reviews.php?error=Database error: " . mysqli_error($con));
        exit();
    }
}

// Fetch all reviews from the database
$query = "SELECT * FROM reviews ORDER BY review_date DESC";
$result = mysqli_query($con, $query);
?>

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

                                    <!-- Show success or error message -->
                                    <?php if (isset($_GET['success']) || isset($_GET['error'])) { ?>
                                        <div id="alert-box" class="alert 
                                            <?= isset($_GET['success']) ? 'alert-success' : 'alert-danger' ?>"
                                            role="alert">
                                            <?= isset($_GET['success']) ? $_GET['success'] : $_GET['error'] ?>
                                        </div>
                                        <script>
                                            setTimeout(() => {
                                                document.getElementById('alert-box').style.display = 'none';
                                            }, 5000); // Hide after 5 seconds
                                        </script>
                                    <?php } ?>

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
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?= $row['user_id'] ?></td>
                                                        <td><?= $row['comment'] ?></td>
                                                        <td><?= $row['rating'] ?> ★</td>
                                                        <td><?= $row['review_date'] ?></td>
                                                        <td>
                                                            <?php if ($row['status'] == 'Pending') { ?>
                                                                <label class="badge badge-warning">Pending</label>
                                                            <?php } elseif ($row['status'] == 'Approved') { ?>
                                                                <label class="badge badge-success">Approved</label>
                                                            <?php } else { ?>
                                                                <label class="badge badge-danger">Spam</label>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($row['status'] == 'Pending') { ?>
                                                                <!-- Approve Review Button -->
                                                                <form method="POST" style="display:inline-block;">
                                                                    <input type="hidden" name="review_id" value="<?= $row['review_id'] ?>">
                                                                    <input type="hidden" name="approve_review" value="1">
                                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                                </form>
                                                            <?php } ?>
                                                            <!-- Delete Review Button -->
                                                            <form method="POST" style="display:inline-block;">
                                                                <input type="hidden" name="review_id" value="<?= $row['review_id'] ?>">
                                                                <input type="hidden" name="delete_review" value="1">
                                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Handle case if no reviews exist -->
                                    <?php if (mysqli_num_rows($result) == 0) { ?>
                                        <p>No reviews found.</p>
                                    <?php } ?>
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