<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['admin_name'];
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];
    $confirm_password = $_POST['admin_password'];
    $role = 'admin';
    $status = $_POST['admin_status'];

    // Handling file upload
    $profile_picture = $_FILES['admin_profile_picture']['name'];
    $file_name = uniqid() . '_' . $profile_picture;
    $target_dir = "../assets/images/profile_picture/";
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES['admin_profile_picture']['tmp_name'], $target_file)) {
        // Insert data into the database
        $sql = "INSERT INTO users (fullname, email, password, confirm_password, role, status, profile_picture) 
                VALUES ('$fullname', '$email', '$password', '$confirm_password', '$role', '$status', '$file_name')";

        if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            header("Location: admin_add_admin.php?success=Admin added successfully.");
            exit();
        } else {
            mysqli_close($con);
            header("Location: admin_add_admin.php?error=Database error: " . mysqli_error($con));
            exit();
        }
    } else {
        header("Location: admin_add_admin.php?error=Error uploading profile picture.");
        exit();
    }
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
                                    <h4 class="card-title">Add Admin</h4>
                                    <form class="form-sample" id="addadmin" method="post" enctype="multipart/form-data">
                                        <p class="card-description"> Admin Details </p>
                                        <div class="row">
                                            <!-- Admin Name -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Admin Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Enter admin name" name="admin_name">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control" placeholder="Enter email" name="admin_email">
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
                                                        <input type="password" class="form-control" placeholder="Enter password" name="admin_password">
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Password -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Enter confirm password" name="admin_confirm_password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- <p class="card-description"> Profile Picture </p> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" name="admin_status">
                                                            <option value="" disabled selected>Select Status</option>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Profile Picture -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Upload Picture</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" accept="image/*" name="admin_profile_picture">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" style="background-color:rgb(0, 103, 193);">Add Admin</button>
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
            // Custom file size validation method
            $.validator.addMethod("filesize", function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, "File size must be less than 2MB");

            // Form Validation
            $('#addadmin').validate({
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
                        minlength: 6,
                        maxlength: 20,
                        pattern: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/
                    },
                    admin_confirm_password: {
                        required: true,
                        equalTo: "[name='admin_password']"
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
                        minlength: "Password must be at least 6 characters",
                        maxlength: "Password cannot exceed 20 characters",
                        pattern: "Password must contain at least one letter and one number"
                    },
                    admin_confirm_password: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
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
            $('#addadmin').submit(function(e) {
                if (!$(this).valid()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>