<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Edit Profile">
    <meta name="keywords" content="profile, edit, user">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
</head>

<body>
    <?php
    include_once('user_header.php');

    // Dummy user data (Replace this with actual database values)
    $user = [
        'fullname' => 'John Doe',
        'mobileno' => '9876543210',
        'email' => 'john@example.com',
        'address' => '123, Sample Street, City',
        'profile_picture' => '../assets/images/room/avatar/avatar-1.jpg' // Default profile pic
    ];
    ?>

    <?php
    include_once('user_header.php');
    ?>

    <!-- Edit Profile Section Begin -->
    <br>
    <section>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-8">
                    <div class="card">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Edit Your Profile</h2>

                            <form id="editprofileform" name="editprofileform" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="fullname"><i class="fa fa-user"></i> Full Name</label>
                                            <input type="text" id="fullname" name="fullname" class="form-control" value="<?= $user['fullname'] ?>" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="mobile"><i class="fa fa-phone"></i> Mobile No</label>
                                            <input type="text" id="mobileno" name="mobileno" class="form-control" value="<?= $user['mobileno'] ?>" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email"><i class="fa fa-envelope"></i> Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?= $user['email'] ?>" required />
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="address"><i class="fa fa-map-marker"></i> Address</label>
                                            <input type="text" id="address" name="address" class="form-control" value="<?= $user['address'] ?>" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="profile_picture"><i class="fa fa-image"></i> Profile Picture</label>
                                            <input type="file" id="profile_picture" name="profile_picture" class="form-control" />
                                            <br>
                                            <img src="<?= $user['profile_picture'] ?>" alt="Profile Picture" class="img-thumbnail" width="150">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-lg" style="background-color: #0B032D;">Save Changes</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>
    <!-- Edit Profile Section End -->

    <?php
    include('user_footer.php');
    ?>


    <!-- JS -->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#editprofileform").submit(function(e) {
                e.preventDefault();
                if ($('#editprofileform').valid()) {
                    alert('Profile updated successfully');
                    this.submit();
                }
            });

            $('#editprofileform').validate({
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
                    address: {
                        required: true,
                        minlength: 5,
                        maxlength: 100
                    },
                    profile_picture: {
                        extension: "jpg|jpeg|png|gif"
                    }
                },
                messages: {
                    fullname: {
                        required: "Full name is required",
                        minlength: "Full name must contain at least 3 characters",
                        maxlength: "Full name cannot exceed 30 characters",
                        pattern: "Full name should contain only letters and spaces"
                    },
                    mobileno: {
                        required: "Mobile number is required",
                        digits: "Only digits are allowed",
                        minlength: "Mobile number must be exactly 10 digits",
                        maxlength: "Mobile number must be exactly 10 digits"
                    },
                    email: {
                        required: "Email is required",
                        email: "Enter a valid email address"
                    },
                    address: {
                        required: "Address is required",
                        minlength: "Address must be at least 5 characters",
                        maxlength: "Address cannot exceed 100 characters"
                    },
                    profile_picture: {
                        extension: "Only JPG, JPEG, PNG, or GIF files are allowed"
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
        });
    </script>
</body>

</html>