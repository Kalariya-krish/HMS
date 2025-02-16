<?php
session_start();
include_once("db_connection.php");
if (isset($_SESSION['reg_msg'])) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertmsg">
        <strong>Success</strong> <?php echo $_SESSION['reg_msg']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        setTimeout("", 5000);
    </script>
<?php
    unset($_SESSION['reg_msg']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

</head>

<body>
    <?php
    include_once('header.php');
    ?>
    <br>
    <section>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-8">
                    <div class="card">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Register Hear ...</h2>

                            <form id="registerform" action="register_insert_data.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="fullname"><i class="fa fa-user"></i> Full Name</label>
                                            <input type="text" id="fullname" name="fullname" class="form-control" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="mobile"><i class="fa fa-phone"></i> Mobile No</label>
                                            <input type="text" id="mobileno" name="mobileno" class="form-control" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email"><i class="fa fa-envelope"></i> Email</label>
                                            <input type="email" id="email" name="email" class="form-control" />
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password"><i class="fa fa-lock"></i> Password</label>
                                            <input type="password" id="password" name="password" class="form-control" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="confirm_password"><i class="fa fa-lock"></i> Confirm Password</label>
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="address"><i class="fa fa-map-marker"></i> Address</label>
                                            <input type="text" id="address" name="address" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="profile_picture"><i class="fa fa-image"></i> Profile Picture</label>
                                        <input type="file" id="profile_picture" name="profile_picture" class="form-control" required />
                                    </div>
                                </div>

                                <!-- <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="terms" required />
                                    <label class="form-check-label" for="terms">
                                        I agree to all statements in <a href="#" class="text-body"><u>Terms of Service</u></a>
                                    </label>
                                </div> -->

                                <div class="d-flex justify-content-center">
                                    <button type="submit" name="submit" class="btn btn-success btn-md" style="background-color:rgb(0, 103, 193);">Register</button>
                                </div>

                                <p class="text-center text-muted mt-4">Already have an account?
                                    <a href="login.php" class="fw-bold text-body"><u>Login here</u></a>
                                </p>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>

    <?php
    include('footer.php');
    ?>






    <!-- JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#registerform").submit(function(e) {
                if (!$('#registerform').valid()) {
                    e.preventDefault();
                }
            });

            $('#registerform').validate({
                rules: {
                    fullname: {
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                        pattern: /^[a-zA-Z\s]+$/
                    },
                    mobileno: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 20
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    },
                    address: {
                        required: true,
                        minlength: 5,
                        maxlength: 100
                    },
                    profile_picture: {
                        required: true,
                        extension: "jpg|jpeg|png",
                        filesize: 2097152 // 2MB
                    }
                },
                messages: {
                    fullname: {
                        required: "Full name is required",
                        minlength: "Full name must be at least 3 characters",
                        maxlength: "Full name cannot exceed 30 characters",
                        pattern: "Only letters and spaces are allowed"
                    },
                    mobileno: {
                        required: "Mobile number is required",
                        digits: "Only numbers are allowed",
                        minlength: "Mobile number must be exactly 10 digits",
                        maxlength: "Mobile number must be exactly 10 digits"
                    },
                    email: {
                        required: "Email is required",
                        email: "Enter a valid email"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 8 characters",
                        maxlength: "Password cannot exceed 20 characters"
                    },
                    confirm_password: {
                        required: "Confirm password is required",
                        equalTo: "Confirm passwords do not match with password"
                    },
                    address: {
                        required: "Address is required",
                        minlength: "Address must be at least 5 characters",
                        maxlength: "Address cannot exceed 100 characters"
                    },
                    profile_picture: {
                        required: "Profile picture is required",
                        extension: "Only JPG, JPEG, PNG files are allowed",
                        filesize: "File size must be less than 2MB"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });

            // Custom file size validation method
            $.validator.addMethod("filesize", function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, "File size must be less than 2MB");
        });
    </script>


</body>

</html>