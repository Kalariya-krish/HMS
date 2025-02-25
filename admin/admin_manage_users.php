<?php
// Include your database conection file
include('../db_connection.php');

// Handle User Update
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
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

    $query = "UPDATE users SET fullname='$username', email='$email', role='$role', status='$status', profile_picture='$profile_picture' $password_update WHERE id='$user_id'";
    mysqli_query($con, $query);
    header("Location: admin_manage_users.php");
    exit();
}

// Handle User Deletion
if (isset($_GET['delete_id'])) {
    $user_id = $_GET['delete_id'];

    // Delete the user
    $deleteUser = "DELETE FROM users WHERE id = '$user_id'";
    if (mysqli_query($con, $deleteUser)) {
        echo "<script>alert('User deleted successfully!'); window.location='admin_manage_users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user!');</script>";
    }
}

// Handle Status Change
if (isset($_GET['status_id']) && isset($_GET['status'])) {
    $user_id = $_GET['status_id'];
    $new_status = $_GET['status'];
    mysqli_query($con, "UPDATE users SET status='$new_status' WHERE id='$user_id'");
    header("Location: admin_manage_users.php");
    exit();
}

// Fetch Users Data
$result = mysqli_query($con, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
                            <h4 class="card-title">Manage Users</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Profile Picture</th>
                                            <th>ID</th>
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Mobile no.</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td>
                                                    <img src="../assets/images/profile_picture/<?php echo $user['profile_picture']; ?>"
                                                        alt="User Image" class="img-fluid rounded-circle" width="50">
                                                </td>
                                                <td>#<?php echo $user['id']; ?></td>
                                                <td><?php echo $user['fullname']; ?></td>
                                                <td><?php echo $user['email']; ?></td>
                                                <td><?php echo $user['password']; ?></td>
                                                <td><?php echo $user['mobile_no']; ?></td>
                                                <td><?php echo $user['address']; ?></td>
                                                <td><?php echo ucfirst($user['role']); ?></td>
                                                <td>
                                                    <a href="?status_id=<?php echo $user['id']; ?>&status=<?php echo ($user['status'] == 'active') ? 'inactive' : 'active'; ?>"
                                                        class="btn btn-sm btn-<?php echo ($user['status'] == 'active') ? 'success' : 'danger'; ?>">
                                                        <i class="fas fa-toggle-<?php echo ($user['status'] == 'active') ? 'on' : 'off'; ?>"></i>
                                                        <?php echo ucfirst($user['status']); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-sm edit-btn" data-user='<?php echo json_encode($user); ?>'>
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <a href="?delete_id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this user?');">
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
            <h4 class="card-title">Edit User</h4><br><br>
            <form class="form-sample" id="editForm" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <!-- User ID -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">User ID</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="user_id" id="editUserId" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="username" id="editUsername">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" id="editEmail" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="role" id="editRole" readonly>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="staff">Staff</option>
                                    <option value="guest">Guest</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Status -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="status" id="editStatus">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="banned">Banned</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Picture -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Profile Picture</label>
                            <div class="col-sm-10">
                                <img id="profilePreview" src="../assets/images/profile_picture/<?php echo $user['profile_picture']; ?>" alt="Profile Picture" style="border-radius: 50%; height:100px; width:100px;"><br><br>
                                <input type="file" class="form-control" name="profile_picture">
                                <input type="hidden" name="current_picture" id="currentPicture">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success" name="update_user">Save Changes</button>
                <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
            </form>
        </div>
    </div>
    <!-- Edit Modal End -->

    <script>
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", () => {
                let data = JSON.parse(button.getAttribute("data-user"));

                // Populate text fields
                document.getElementById("editUserId").value = data.id;
                document.getElementById("editUsername").value = data.fullname;
                document.getElementById("editEmail").value = data.email;
                document.getElementById("editRole").value = data.role;
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