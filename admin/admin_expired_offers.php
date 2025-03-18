<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle delete offer action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_offer'])) {
    $offer_id = $_POST['offer_id'];

    // Delete the expired offer from the database
    $delete_query = "DELETE FROM offers WHERE offer_id='$offer_id'";

    if (mysqli_query($con, $delete_query)) {
        header("Location: admin_expired_offers.php?success=Offer Deleted Successfully");
        exit();
    } else {
        header("Location: admin_expired_offers.php?error=Database error: " . mysqli_error($con));
        exit();
    }
}

// Fetch expired offers (offers with valid_until < current date)
$current_date = date('Y-m-d');
$query = "SELECT * FROM offers WHERE valid_until < '$current_date' ORDER BY valid_until DESC";
$result = mysqli_query($con, $query);
?>

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
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><img src="../assets/images/offers/<?= $row['offer_image'] ?>" alt="Offer Image" class="img-fluid rounded"></td>
                                                        <td><?= $row['offer_title'] ?></td>
                                                        <td><?= $row['discount_percentage'] ?>%</td>
                                                        <td><?= $row['valid_from'] ?></td>
                                                        <td><?= $row['valid_until'] ?></td>
                                                        <td><?= $row['offer_description'] ?></td>
                                                        <td>
                                                            <!-- Delete Offer Button -->
                                                            <form method="POST" style="display:inline-block;">
                                                                <input type="hidden" name="offer_id" value="<?= $row['offer_id'] ?>">
                                                                <input type="hidden" name="delete_offer" value="1">
                                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Handle case if no expired offers exist -->
                                    <?php if (mysqli_num_rows($result) == 0) { ?>
                                        <p>No expired offers found.</p>
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