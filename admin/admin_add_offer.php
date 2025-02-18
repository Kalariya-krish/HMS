<?php
include '../db_connection.php'; // Database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $offer_title = $_POST['offer_title'];
    $discount = $_POST['discount'];
    $valid_from = $_POST['valid_from'];
    $valid_to = $_POST['valid_until'];
    $offer_description = $_POST['offer_description'];
    $status = 'Active'; // Default status

    // File upload handling
    $target_dir = "../assets/images/offers/";
    $offer_image = uniqid() . basename($_FILES["offer_image"]["name"]);
    $target_file = $target_dir . $offer_image;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Move file to target directory
    if (move_uploaded_file($_FILES["offer_image"]["tmp_name"], $target_file)) {
        // Insert into database
        $query = "INSERT INTO offers (offer_title, discount_percentage, valid_from, valid_to, offer_description, offer_image, status) 
                  VALUES ('$offer_title', '$discount', '$valid_from', '$valid_to', '$offer_description', '$offer_image', '$status')";

        if (mysqli_query($con, $query)) {
            header("Location: admin_add_offer.php?success=Offer added successfully.");
            exit();
        } else {
            header("Location: admin_add_offer.php?error=Database error: " . mysqli_error($con));
            exit();
        }
    } else {
        header("Location: admin_add_offer.php?error=Error uploading image.");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Offer</title>
    <link rel="stylesheet" href="../assets/css/admin_style.css">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add Offer</h4>

                                    <!-- Success/Error Message -->
                                    <?php if (isset($_GET['success']) || isset($_GET['error'])) { ?>
                                        <div id="alert-box" class="alert <?= isset($_GET['success']) ? 'alert-success' : 'alert-danger' ?>" role="alert">
                                            <?= isset($_GET['success']) ? $_GET['success'] : $_GET['error'] ?>
                                        </div>
                                        <script>
                                            setTimeout(() => {
                                                document.getElementById('alert-box').style.display = 'none';
                                            }, 3000);
                                        </script>
                                    <?php } ?>

                                    <form class="form-sample" id="addoffer" action="" method="POST" enctype="multipart/form-data">
                                        <p class="card-description">Offer Details</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Offer Title</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Enter offer title" name="offer_title" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Discount (%)</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Enter discount percentage" name="discount" min="0" max="100" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Valid From</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="valid_from" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Valid Until</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="valid_until" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Offer Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" rows="3" placeholder="Enter offer details" name="offer_description" required></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Offer Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" accept="image/*" name="offer_image" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" style="background-color:rgb(0, 103, 193);">Add Offer</button>
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

            $('#addoffer').validate({
                rules: {
                    offer_title: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    discount: {
                        required: true,
                        number: true,
                        min: 0,
                        max: 100
                    },
                    valid_from: {
                        required: true,
                        date: true
                    },
                    valid_until: {
                        required: true,
                        date: true
                    },
                    offer_description: {
                        required: true,
                        minlength: 10
                    },
                    offer_image: {
                        required: true,
                        extension: "jpg|jpeg|png|gif",
                        filesize: 2097152 // 2MB
                    }
                },
                messages: {
                    offer_title: {
                        required: "Offer title is required",
                        minlength: "Offer title must be at least 3 characters",
                        maxlength: "Offer title cannot exceed 50 characters"
                    },
                    discount: {
                        required: "Discount percentage is required",
                        number: "Enter a valid number",
                        min: "Discount cannot be less than 0%",
                        max: "Discount cannot exceed 100%"
                    },
                    valid_from: {
                        required: "Please select the start date",
                        date: "Enter a valid date"
                    },
                    valid_until: {
                        required: "Please select the end date",
                        date: "Enter a valid date"
                    },
                    offer_description: {
                        required: "Offer description is required",
                        minlength: "Description must be at least 10 characters"
                    },
                    offer_image: {
                        required: "Offer image is required",
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
            $('#addoffer').submit(function(e) {
                if (!$(this).valid()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>