<?php

include_once('../db_connection.php');
include_once('../auth_check.php');

$id = $_SESSION['id'];
$email = $_SESSION['email'];

$q = "SELECT * FROM users WHERE id = '$id' AND email = '$email'";
$res = mysqli_query($con, $q);
while ($data = mysqli_fetch_array($res)) {
    $photo = $data['profile_picture'];
    $fullname = $data['fullname'];
    $mobile_no = $data['mobile_no'];
    $address = $data['address'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $mobile_no = $_POST['mobile_no'];
    $address = $_POST['address'];

    if (!empty($_FILES['profile_picture']['name'])) {
        $profile_picture = uniqid() . "_" . $_FILES['profile_picture']['name'];
        $profile_tmp = $_FILES['profile_picture']['tmp_name'];

        // Delete old profile picture if exists
        if (!empty($photo) && file_exists("../assets/images/profile_picture/" . $photo)) {
            unlink("../assets/images/profile_picture/" . $photo);
        }

        move_uploaded_file($profile_tmp, "../assets/images/profile_picture/" . $profile_picture);

        $query = "UPDATE users SET fullname='$fullname', mobile_no='$mobile_no', address='$address', profile_picture='$profile_picture' WHERE id='$id' AND email='$email'";
    } else {
        $query = "UPDATE users SET fullname='$fullname', mobile_no='$mobile_no', address='$address' WHERE id='$id' AND email='$email'";
    }

    if (mysqli_query($con, $query)) {
        echo "<script>alert('Profile updated successfully'); window.location.href='user_edit_profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($con) . "');</script>";
    }
}
?>

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
    ?>

    <!-- Edit Profile Section Begin -->

    <br>
    <section>
        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card p-4">
                        <h2 class="text-center mb-5">Edit Your Profile</h2>
                        <form action="user_edit_profile.php" id="editprofileform" method="post" enctype="multipart/form-data">
                            <div class="row align-items-center">
                                <!-- Profile Picture Section -->
                                <div class="col-md-4 text-center">
                                    <img src="../assets/images/profile_picture/<?php echo $photo; ?>" class="img-thumbnail" width="150" alt="Profile Picture">
                                    <br><br>
                                    <input type="file" id="profile_picture" name="profile_picture" class="form-control mb-3">
                                </div>

                                <!-- Form Section -->
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Full Name</label>
                                                <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Mobile No</label>
                                                <input type="text" name="mobile_no" class="form-control" value="<?php echo $mobile_no; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" readonly>
                                        </div>
                                        <div class="mb-5">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button name="edit_profile" type="submit" class="btn btn-success btn-md" style="background-color: #0B032D;">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                    mobile_no: {
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
                    mobile_no: {
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