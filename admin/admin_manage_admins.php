<?php
// Include your database conection file
include('../db_connection.php');

// Handle admin Update
if (isset($_POST['update_admin'])) {
    $admin_id = $_POST['admin_id'];
    $adminname = $_POST['adminname'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    // Only update password if a new one is provided
    $password_update = "";
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        $password_update = ", password='$password'";
    }

    $profile_picture = $_POST['current_picture'];
    if (!empty($_FILES['profile_picture']['name'])) {
        $profile_picture = uniqid() . "_" . $_FILES['profile_picture']['name'];
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], "../assets/images/profile_picture/" . $profile_picture);
    }

    $query = "UPDATE users SET fullname='$adminname', email='$email', status='$status', profile_picture='$profile_picture' $password_update WHERE id='$admin_id'";
    mysqli_query($con, $query);
    header("Location: admin_manage_admins.php");
    exit();
}

// Handle admin Deletion
if (isset($_GET['delete_id'])) {
    $admin_id = $_GET['delete_id'];

    // Delete the admin
    $deleteadmin = "DELETE FROM users WHERE id = '$admin_id'";
    if (mysqli_query($con, $deleteadmin)) {
        echo "<script>alert('Admin deleted successfully!'); window.location='admin_manage_admins.php';</script>";
    } else {
        echo "<script>alert('Error deleting admin!');</script>";
    }
}

// Handle Status Change
if (isset($_GET['status_id']) && isset($_GET['status'])) {
    $admin_id = $_GET['status_id'];
    $new_status = $_GET['status'];
    mysqli_query($con, "UPDATE users SET status='$new_status' WHERE id='$admin_id'");
    header("Location: admin_manage_admins.php");
    exit();
}

// Fetch admins Data
$result = mysqli_query($con, "SELECT * FROM users where role='admin' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage admins</title>
    <link rel="stylesheet" href="../assets/css/admin_editform_style.css">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Manage Admins</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Profile Picture</th>
                                            <th>Admin ID</th>
                                            <th>Admin Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($admin = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td>
                                                    <img src="../assets/images/profile_picture/<?php echo $admin['profile_picture']; ?>"
                                                        alt="admin Image" class="img-fluid rounded-circle" width="50">
                                                </td>
                                                <td>#<?php echo $admin['id']; ?></td>
                                                <td><?php echo $admin['fullname']; ?></td>
                                                <td><?php echo $admin['email']; ?></td>
                                                <td><?php echo $admin['password']; ?></td>
                                                <td>
                                                    <a href="?status_id=<?php echo $admin['id']; ?>&status=<?php echo ($admin['status'] == 'active') ? 'inactive' : 'active'; ?>"
                                                        class="btn btn-sm btn-<?php echo ($admin['status'] == 'active') ? 'success' : 'danger'; ?>">
                                                        <i class="fas fa-toggle-<?php echo ($admin['status'] == 'active') ? 'on' : 'off'; ?>"></i>
                                                        <?php echo ucfirst($admin['status']); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-sm edit-btn" data-admin='<?php echo json_encode($admin); ?>'>
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <a href="?delete_id=<?php echo $admin['id']; ?>" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this admin?');">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal Start -->
    <div class="overlay" id="editModal">
        <div class="popup-card">
            <h4 class="card-title">Edit Admin</h4><br><br>
            <form class="form-sample" id="editForm" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <!-- admin ID -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">admin ID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="admin_id" id="editadminId" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- adminname -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">adminname</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="adminname" id="editadminname">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="editEmail" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="status" id="editStatus">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="banned">Banned</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">



                    <!-- Profile Picture -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Profile Picture</label>
                            <div class="col-sm-9">
                                <img id="profilePreview" src="../assets/images/profile_picture/<?php echo $admin['profile_picture']; ?>" alt="Profile Picture" style="border-radius: 50%; height:100px; width:100px;"><br><br>
                                <input type="file" class="form-control" name="profile_picture">
                                <input type="hidden" name="current_picture" id="currentPicture">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success" name="update_admin">Save Changes</button>
                <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
            </form>
        </div>
    </div>
    <!-- Edit Modal End -->

    <script>
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", () => {
                let data = JSON.parse(button.getAttribute("data-admin"));

                // Populate text fields
                document.getElementById("editadminId").value = data.id;
                document.getElementById("editadminname").value = data.fullname;
                document.getElementById("editEmail").value = data.email;
                document.getElementById("editStatus").value = data.status;

                // Store current picture value
                document.getElementById("currentPicture").value = data.profile_picture;

                // Update image preview only if profile picture exists
                let imageElement = document.getElementById("profilePreview");
                if (data.profile_picture) {
                    imageElement.src = "../assets/images/profile_picture/" + data.profile_picture;
                } else {
                    imageElement.src = "../assets/images/default_profile.png"; // Use a default image if none exists
                }

                // Show the modal
                document.getElementById("editModal").style.display = "flex";
            });
        });


        // Close modal
        document.getElementById("closeModal").addEventListener("click", () => {
            document.getElementById("editModal").style.display = "none";
        });
    </script>
</body>

</html>