<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add User</h4>
                                    <form class="form-sample">
                                        <p class="card-description"> User Details </p>
                                        <div class="row">
                                            <!-- Username -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Enter username" name="username">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control" placeholder="Enter email" name="email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Password -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" placeholder="Enter password" name="password">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" placeholder="Confirm password" name="confirm_password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Role -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Role</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" name="role">
                                                            <option value="" disabled selected>Select Role</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="manager">Manager</option>
                                                            <option value="staff">Staff</option>
                                                            <option value="guest">Guest</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" name="status">
                                                            <option value="" disabled selected>Select Status</option>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                            <option value="banned">Banned</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="card-description"> Profile Picture </p>
                                        <div class="row">
                                            <!-- Profile Picture -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Upload Picture</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" accept="image/*"  name="profile_picture">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" style="background-color:rgb(0, 103, 193);">Add User</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
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