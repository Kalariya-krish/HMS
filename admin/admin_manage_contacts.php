<?php
// Include your database connection
include '../db_connection.php';

// Delete Contact Inquiry - Perform the delete action if the 'delete_id' parameter is provided
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM contact_inquiries WHERE message_id = $delete_id";
    if (mysqli_query($con, $delete_query)) {
        echo "<script>alert('Inquiry deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting inquiry.');</script>";
    }
}

// Fetch all contact inquiries from the database
$query = "SELECT * FROM contact_inquiries ORDER BY sent_at DESC";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contact Inquiries</title>
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
                                    <h4 class="card-title">Manage Contact Inquiries</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <tr>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['subject']; ?></td>
                                                        <td><?php echo substr($row['message'], 0, 50) . '...'; ?></td>
                                                        <td><?php echo $row['sent_at']; ?></td>
                                                        <td>
                                                            <!-- Optionally, you can implement a view button to see full details -->
                                                            <!-- <a href="view_contact.php?message_id=<?php echo $row['message_id']; ?>" class="btn btn-info btn-sm">View</a> -->
                                                            <a href="?delete_id=<?php echo $row['message_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this inquiry?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
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