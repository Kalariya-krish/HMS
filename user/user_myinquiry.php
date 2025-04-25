<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Get the logged-in user's email from session
$user_email = $_SESSION['email'];

// Fetch all contact inquiries for this user
$query = "SELECT * FROM contact_inquiries WHERE email = '$user_email' ORDER BY sent_at DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Inquiries</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .inquiry-card {
            border-left: 4px solid;
            margin-bottom: 20px;
        }

        .status-pending {
            border-left-color: #ffc107;
        }

        .status-resolved {
            border-left-color: #28a745;
        }
    </style>
</head>

<body>
    <?php include_once('user_header.php'); ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>My Inquiries</h2>
                    <a href="user_contact_us.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Inquiry
                    </a>
                </div>

                <?php if (mysqli_num_rows($result) > 0): ?>
                    <div class="list-group">
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <div class="card inquiry-card status-<?php echo $row['status']; ?> mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title"><?php echo htmlspecialchars($row['subject']); ?></h5>
                                            <p class="card-text text-muted">
                                                Submitted on: <?php echo date('F j, Y, g:i a', strtotime($row['sent_at'])); ?>
                                            </p>
                                        </div>
                                        <div>
                                            <span class="badge bg-<?php echo $row['status'] == 'resolved' ? 'success' : 'warning'; ?>">
                                                <?php echo ucfirst($row['status']); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <p class="card-text mt-3"><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>

                                    <?php if (!empty($row['admin_notes'])): ?>
                                        <div class="alert alert-info mt-3">
                                            <strong>Admin Response:</strong>
                                            <p><?php echo nl2br(htmlspecialchars($row['admin_notes'])); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        You haven't submitted any inquiries yet.
                        <a href="user_contact_us.php" class="alert-link">Click here to submit a new inquiry</a>.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>