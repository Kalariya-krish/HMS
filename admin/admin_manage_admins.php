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
                                    <h4 class="card-title">Manage Admins</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Profile Picture</th>
                                                    <th>Admin Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Profile Picture" class="img-fluid rounded-circle">
                                                    </td>
                                                    <td>John Doe</td>
                                                    <td>john.doe@example.com</td>
                                                    <td><label class="badge badge-success">Active</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Profile Picture" class="img-fluid rounded-circle">
                                                    </td>
                                                    <td>Jane Smith</td>
                                                    <td>jane.smith@example.com</td>
                                                    <td><label class="badge badge-warning">Inactive</label></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm">Edit</button>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="https://via.placeholder.com/50" alt="Profile Picture" class="img-fluid rounded-circle">
                                                    </td>
                                                    <td>Robert Brown</td>
                                                    <td>robert.brown@example.com</td>
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



    <!-- Edit Modal -->
    <div class="overlay" id="editModal">
        <div class="popup-card">
            <h4 class="card-title">Edit Admin</h4><br><br>
            <form class="form-sample" id="editAdmin" method="post" enctype="multipart/form-data">
                <input type="hidden" name="admin_id" id="edit_admin_id">

                <div class="row">
                    <!-- Admin Name -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Admin Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Enter admin name" name="admin_name" id="edit_admin_name">
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" placeholder="Enter email" name="admin_email" id="edit_admin_email">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Password -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" placeholder="Enter new password (leave blank to keep current)" name="admin_password" id="edit_admin_password">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="admin_status" id="edit_admin_status">
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
                            <label class="col-sm-4 col-form-label">Current Picture</label>
                            <div class="col-sm-8">
                                <img id="current_profile_picture" src="../assets/images/room/avatar/avatar-1.jpg" alt="Current Profile Picture" class="img-fluid rounded-circle" style="max-width: 100px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">New Picture</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" accept="image/*" name="admin_profile_picture" id="edit_admin_profile_picture">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update Admin</button>
                        <button type="button" class="btn btn-secondary" id="closeEditModal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Handle edit button clicks
            $('.btn-info').click(function() {
                const row = $(this).closest('tr');
                const adminId = $(this).data('id');
                const adminName = row.find('td:eq(1)').text();
                const adminEmail = row.find('td:eq(2)').text();
                const adminStatus = row.find('.badge').text().toLowerCase();
                const profilePicture = row.find('img').attr('src');

                // Populate the edit form
                $('#edit_admin_id').val(adminId);
                $('#edit_admin_name').val(adminName);
                $('#edit_admin_email').val(adminEmail);
                $('#edit_admin_status').val(adminStatus);
                $('#current_profile_picture').attr('src', profilePicture);
                $('#edit_admin_password').val(''); // Clear password field

                // Show the modal
                $('#editModal').css('display', 'flex');
            });

            // Close modal handlers
            $('#closeEditModal').click(function() {
                $('#editModal').css('display', 'none');
            });

            $(window).click(function(e) {
                if (e.target.id === 'editModal') {
                    $('#editModal').css('display', 'none');
                }
            });

            // Custom file size validation method
            $.validator.addMethod("filesize", function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, "File size must be less than 2MB");

            // Form Validation
            $('#editAdmin').validate({
                rules: {
                    admin_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    admin_email: {
                        required: true,
                        email: true
                    },
                    admin_password: {
                        required: true,
                        minlength: 6
                    },
                    admin_status: {
                        required: true
                    },
                    admin_profile_picture: {
                        required: true,
                        extension: "jpg|jpeg|png|gif",
                        filesize: 2097152 // 2MB
                    }
                },
                messages: {
                    admin_name: {
                        required: "Admin name is required",
                        minlength: "Admin name must be at least 3 characters",
                        maxlength: "Admin name cannot exceed 50 characters"
                    },
                    admin_email: {
                        required: "Email is required",
                        email: "Please enter a valid email address"
                    },
                    admin_password: {
                        required: "Password is required",
                        minlength: "Password must be at least 6 characters"
                    },
                    admin_status: {
                        required: "Please select a status"
                    },
                    admin_profile_picture: {
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
            $('#editAdmin').submit(function(e) {
                if (!$(this).valid()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>