<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/admin_editform_style.css">
</head>

<body>
    <div class="container-scroller">
        <!-- Sidebar -->
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
            <!-- Main Panel -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Users</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profile Picture</th>
                                                    <th>User ID</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Example User 1 -->
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/50" alt="User Image" class="img-fluid rounded-circle"></td>
                                                    <td>#U001</td>
                                                    <td>john_doe</td>
                                                    <td>john@example.com</td>
                                                    <td><label class="badge badge-success">Active</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <!-- Example User 2 -->
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/50" alt="User Image" class="img-fluid rounded-circle"></td>
                                                    <td>#U002</td>
                                                    <td>jane_smith</td>
                                                    <td>jane@example.com</td>
                                                    <td><label class="badge badge-warning">Inactive</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <!-- Example User 3 -->
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/50" alt="User Image" class="img-fluid rounded-circle"></td>
                                                    <td>#U003</td>
                                                    <td>chris_brown</td>
                                                    <td>chris@example.com</td>
                                                    <td><label class="badge badge-success">Active</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <!-- Example User 4 -->
                                                <tr>
                                                    <td><img src="https://via.placeholder.com/50" alt="User Image" class="img-fluid rounded-circle"></td>
                                                    <td>#U004</td>
                                                    <td>emily_white</td>
                                                    <td>emily@example.com</td>
                                                    <td><label class="badge badge-danger">Banned</label></td>
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
    </div>


    <!-- Edit User Modal -->
    <div class="overlay" id="editUserModal">
        <div class="popup-card">
            <h4 class="card-title">Edit User</h4><br><br>
            <form class="form-sample" id="editUserForm">
                <input type="hidden" id="editUserId">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editUsername" name="username" placeholder="Enter username">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="editEmail" name="email" placeholder="Enter email">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="editPassword" name="password" placeholder="Enter new password">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="editConfirmPassword" name="confirm_password" placeholder="Confirm new password">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editRole" name="role">
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="staff">Staff</option>
                                    <option value="guest">Guest</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editStatus" name="status">
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="banned">Banned</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Profile Picture</label>
                            <div class="col-sm-8">
                                <img src="../assets/images/room/avatar/avatar-1.jpg" alt="">
                                <input type="file" class="form-control" id="editProfilePicture" name="profile_picture" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update User</button>
                        <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editUserModal = document.getElementById('editUserModal');
            const editButtons = document.querySelectorAll('.btn-info');

            // Edit button click handler
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get the parent row
                    const row = this.closest('tr');

                    // Extract user details from the row
                    const userId = row.querySelector('td:nth-child(2)').textContent;
                    const username = row.querySelector('td:nth-child(3)').textContent;
                    const email = row.querySelector('td:nth-child(4)').textContent;
                    const status = row.querySelector('td:nth-child(5) .badge').textContent.toLowerCase();

                    // Populate modal fields
                    document.getElementById('editUserId').value = userId;
                    document.getElementById('editUsername').value = username;
                    document.getElementById('editEmail').value = email;
                    document.getElementById('editStatus').value = status;

                    // Show modal
                    editUserModal.style.display = 'flex';
                });
            });

            // Close modal when clicking outside
            editUserModal.addEventListener('click', function(e) {
                if (e.target === editUserModal) {
                    editUserModal.style.display = 'none';
                }
            });

            closeModal.addEventListener("click", () => {
                editUserModal.style.display = "none";
            });

            // Handle form submission (you'd replace this with actual save logic)
            // document.getElementById('editOfferForm').addEventListener('submit', (e) => {
            //     e.preventDefault();
            //     alert('Offer updated! (In a real application, this would save to a database)');
            //     editOfferModal.style.display = "none";
            // });
        });
        $(document).ready(function() {
            // Custom method to validate file size (max 2MB)
            $.validator.addMethod("filesize", function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, "File size must be less than 2MB");

            // Form validation
            $('.form-sample').validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "[name='password']"
                    },
                    role: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                    profile_picture: {
                        required: true,
                        extension: "jpg|jpeg|png|gif",
                        filesize: 2097152 // 2MB in bytes
                    }
                },
                messages: {
                    username: {
                        required: "Username is required",
                        minlength: "Username must be at least 3 characters",
                        maxlength: "Username cannot exceed 50 characters"
                    },
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 6 characters"
                    },
                    confirm_password: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    },
                    role: {
                        required: "Please select a role"
                    },
                    status: {
                        required: "Please select a status"
                    },
                    profile_picture: {
                        required: "Profile picture is required",
                        extension: "Only JPG, JPEG, PNG, or GIF files are allowed",
                        filesize: "File size must be less than 2MB"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });

            // Prevent form submission if validation fails
            $('.form-sample').submit(function(e) {
                if (!$(this).valid()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>