<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../config.php'; // Include database connection

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $mobile_no = $_POST['mobile_no'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Handling file upload
    $file_name = uniqid() . $_FILES['profile_picture']['name'];
    $target_dir = "../assets/images/profile_picture/";
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
        // Insert data into the database
        $sql = "INSERT INTO users (fullname, email, password, confirm_password, mobile_no, address, role, status, profile_picture) 
                VALUES ('$fullname', '$email', '$password', '$confirm_password', '$mobile_no', '$address', '$role', '$status', '$file_name')";

        if (mysqli_query($con, $sql)) {
            header("Location: admin_add_user.php?success=User added successfully.");
        } else {
            header("Location: admin_add_user.php?error=Database error: " . mysqli_error($con));
        }
    } else {
        header("Location: add_user.php?error=Error uploading profile picture.");
    }

    mysqli_close($con);
    exit();
}
?>


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
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add User</h4>

                                    <form class="form-sample" action="" method="POST" enctype="multipart/form-data">
                                        <p class="card-description"> User Details </p>
                                        <div class="row">
                                            <!-- Username -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Enter username" name="fullname">
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
                                            <!-- Mobile no -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Mobile no</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Enter mobile no" name="mobile_no">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Address</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" rows="3" placeholder="Enter address" name="address"></textarea>
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
                                                            <input type="file" class="form-control" accept="image/*" name="profile_picture">
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
                    fullname: {
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
                    mobile_no: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    address: {
                        required: true,
                        minlength: 5,
                        maxlength: 255
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
                    fullname: {
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
                    mobile_no: {
                        required: "Mobile number is required",
                        digits: "Please enter a valid 10-digit mobile number",
                        minlength: "Mobile number must be at least 10 digits",
                        maxlength: "Mobile number cannot exceed 10 digits"
                    },
                    address: {
                        required: "Address is required",
                        minlength: "Address must be at least 5 characters",
                        maxlength: "Address cannot exceed 255 characters"
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