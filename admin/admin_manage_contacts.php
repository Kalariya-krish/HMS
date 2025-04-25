<?php
include_once('../db_connection.php');
include_once('../auth_check.php');
include_once('../mailer.php'); // Include the mailer file

// Delete Contact Inquiry
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM contact_inquiries WHERE message_id = $delete_id";
    if (mysqli_query($con, $delete_query)) {
        header("Location: admin_manage_contacts.php?success=Inquiry deleted successfully.");
        exit();
    } else {
        header("Location: admin_manage_contacts.php?error=Error deleting inquiry.");
        exit();
    }
}

// Update Inquiry Status to Resolved
if (isset($_GET['resolve_id'])) {
    $resolve_id = intval($_GET['resolve_id']);

    // Get inquiry details first
    $inquiry_query = "SELECT * FROM contact_inquiries WHERE message_id = $resolve_id";
    $inquiry_result = mysqli_query($con, $inquiry_query);
    $inquiry = mysqli_fetch_assoc($inquiry_result);

    // Update status
    $update_query = "UPDATE contact_inquiries SET status = 'resolved' WHERE message_id = $resolve_id";

    if (mysqli_query($con, $update_query)) {
        // Send resolution email to user
        $email_subject = "Your inquiry has been resolved - " . $inquiry['subject'];
        $email_body = "
        <html>
        <head>
            <title>Inquiry Resolved</title>
        </head>
        <body>
            <h2>Hello {$inquiry['name']},</h2>
            <p>We're pleased to inform you that your inquiry regarding <strong>{$inquiry['subject']}</strong> has been resolved.</p>
            <p>Your original message:</p>
            <blockquote>{$inquiry['message']}</blockquote>
            <p>If you have any further questions, please don't hesitate to contact us.</p>
            <p>Best regards,<br>Astoria Hotel Team</p>
        </body>
        </html>
        ";

        // Send email using PHPMailer
        $email_result = sendEmail($inquiry['email'], $email_subject, $email_body, null);

        if ($email_result === true) {
            header("Location: admin_manage_contacts.php?success=Inquiry marked as resolved and notification sent.");
        } else {
            header("Location: admin_manage_contacts.php?success=Inquiry marked as resolved but email notification failed.");
        }
        exit();
    } else {
        header("Location: admin_manage_contacts.php?error=Error updating inquiry status.");
        exit();
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Display Success/Error Messages -->
                    <?php if (isset($_GET['success'])) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_GET['success']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error'])) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_GET['error']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Contact Inquiries</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                                        <td><?php echo substr(htmlspecialchars($row['message']), 0, 50) . '...'; ?></td>
                                                        <td><?php echo $row['sent_at']; ?></td>
                                                        <td>
                                                            <span class="badge bg-<?php echo $row['status'] == 'resolved' ? 'success' : 'warning'; ?>">
                                                                <?php echo ucfirst($row['status']); ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="admin_view_inquiry.php?message_id=<?php echo $row['message_id']; ?>" class="btn btn-info btn-sm" title="View Details">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <?php if ($row['status'] == 'pending'): ?>
                                                                <a href="?resolve_id=<?php echo $row['message_id']; ?>" class="btn btn-success btn-sm" title="Mark as Resolved">
                                                                    <i class="fas fa-check"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                            <a href="?delete_id=<?php echo $row['message_id']; ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this inquiry?');">
                                                                <i class="fas fa-trash"></i> <!-- Corrected this line -->
                                                            </a>
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>