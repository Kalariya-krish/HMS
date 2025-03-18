<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle Offer actions (Edit or Delete)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['offer_id'])) {
    $offer_id = $_POST['offer_id'];

    // Handle Edit Offer
    if (isset($_POST['edit_offer'])) {
        $offer_title = $_POST['offer_title'];
        $discount_percentage = $_POST['discount_percentage'];
        $valid_from = $_POST['valid_from'];
        $valid_until = $_POST['valid_until'];
        $offer_description = $_POST['offer_description'];

        // Handle offer image upload
        if (isset($_FILES['offer_image']) && $_FILES['offer_image']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../assets/images/offers/";
            $image_name = uniqid() . basename($_FILES["offer_image"]["name"]);
            $target_file = $target_dir . $image_name;
            move_uploaded_file($_FILES["offer_image"]["tmp_name"], $target_file);
        } else {
            $image_name = $_POST['current_image']; // Retain the old image if no new image is uploaded
        }

        $update_query = "UPDATE offers SET offer_title='$offer_title', discount_percentage='$discount_percentage', valid_from='$valid_from', valid_until='$valid_until', offer_description='$offer_description', offer_image='$image_name' WHERE offer_id='$offer_id'";

        if (mysqli_query($con, $update_query)) {
            header("Location: admin_manage_offers.php?success=Offer Updated Successfully");
            exit();
        } else {
            header("Location: admin_manage_offers.php?error=Database error: " . mysqli_error($con));
            exit();
        }
    }

    // Handle Delete Offer
    if (isset($_POST['delete_offer'])) {
        $delete_query = "DELETE FROM offers WHERE offer_id='$offer_id'";

        if (mysqli_query($con, $delete_query)) {
            header("Location: admin_manage_offers.php?success=Offer Deleted Successfully");
            exit();
        } else {
            header("Location: admin_manage_offers.php?error=Database error: " . mysqli_error($con));
            exit();
        }
    }
}

// Fetch all offers
$query = "SELECT * FROM offers ORDER BY valid_from DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Offers</title>
    <link rel="stylesheet" href="../assets/css/admin_style.css">
    <link rel="stylesheet" href="../assets/css/admin_editform_style.css">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Offers</h4>

                                    <!-- Show success or error message -->
                                    <?php if (isset($_GET['success']) || isset($_GET['error'])) { ?>
                                        <div id="alert-box" class="alert 
        <?= isset($_GET['success']) ? 'alert-success' : 'alert-danger' ?>"
                                            role="alert">
                                            <?= isset($_GET['success']) ? $_GET['success'] : $_GET['error'] ?>
                                        </div>
                                        <script>
                                            setTimeout(() => {
                                                document.getElementById('alert-box').style.display = 'none';
                                            }, 5000); // Hide after 5 seconds
                                        </script>
                                    <?php } ?>


                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Offer Title</th>
                                                    <th>Discount (%)</th>
                                                    <th>Valid From</th>
                                                    <th>Valid Until</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><img src="../assets/images/offers/<?= $row['offer_image'] ?>" alt="Offer Image" class="img-fluid rounded"></td>
                                                        <td><?= $row['offer_title'] ?></td>
                                                        <td><?= $row['discount_percentage'] ?>%</td>
                                                        <td><?= $row['valid_from'] ?></td>
                                                        <td><?= $row['valid_until'] ?></td>
                                                        <td>
                                                            <?php
                                                            $current_date = date('Y-m-d');
                                                            if ($row['valid_until'] >= $current_date) { ?>
                                                                <label class="badge badge-success">Active</label>
                                                            <?php } else { ?>
                                                                <label class="badge badge-danger">Expired</label>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <!-- Edit and Delete Buttons -->
                                                            <button class="btn btn-primary btn-sm edit-btn" data-id="<?= $row['offer_id'] ?>" data-title="<?= $row['offer_title'] ?>" data-discount="<?= $row['discount_percentage'] ?>" data-from="<?= $row['valid_from'] ?>" data-until="<?= $row['valid_until'] ?>" data-description="<?= $row['offer_description'] ?>" data-image="<?= $row['offer_image'] ?>">Edit</button>

                                                            <form method="post" style="display:inline-block;">
                                                                <input type="hidden" name="offer_id" value="<?= $row['offer_id'] ?>">
                                                                <input type="hidden" name="delete_offer" value="1">
                                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
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
        </div>
    </div>

    <!-- Edit Offer Modal -->
    <div class="overlay" id="editOfferModal">
        <div class="popup-card">
            <h4 class="card-title">Edit Offer</h4><br><br>
            <form class="form-sample" method="POST" enctype="multipart/form-data" id="editoffer">
                <input type="hidden" name="offer_id" id="editOfferId">
                <input type="hidden" name="current_image" id="currentImage">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Offer Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Enter offer title" name="offer_title" id="editOfferTitle">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Discount (%)</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" placeholder="Enter discount percentage" step="0.01" name="discount_percentage" id="editDiscount">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Valid From</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="valid_from" id="editValidFrom">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Valid Until</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="valid_until" id="editValidUntil">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Offer Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" placeholder="Enter offer details" name="offer_description" id="editOfferDescription"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Offer Image</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" accept="image/*" name="offer_image" id="editOfferImage">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" name="edit_offer" style="background-color:rgb(0, 103, 193);">Update Offer</button>
                        <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Custom file size validation method
            $.validator.addMethod("filesize", function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, "File size must be less than 2MB");

            $('#editoffer').validate({
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

        document.addEventListener("DOMContentLoaded", () => {
            const editOfferModal = document.getElementById("editOfferModal");
            const closeModal = document.getElementById("closeModal");

            // Edit button click handlers
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Populate modal with current offer details
                    const id = button.getAttribute('data-id');
                    const title = button.getAttribute('data-title');
                    const discount = button.getAttribute('data-discount');
                    const validFrom = button.getAttribute('data-from');
                    const validUntil = button.getAttribute('data-until');
                    const description = button.getAttribute('data-description');
                    const image = button.getAttribute('data-image');

                    // Check if the values are being passed correctly to the modal
                    console.log(id, title, discount, validFrom, validUntil, description, image);

                    document.getElementById('editOfferId').value = id;
                    document.getElementById('editOfferTitle').value = title;
                    document.getElementById('editDiscount').value = discount;
                    document.getElementById('editValidFrom').value = validFrom;
                    document.getElementById('editValidUntil').value = validUntil;
                    document.getElementById('editOfferDescription').value = description;
                    document.getElementById('currentImage').value = image;

                    // Show the modal
                    editOfferModal.style.display = "flex"; // Ensure modal display style is set to "flex"
                });
            });

            // Close modal when clicking outside
            editOfferModal.addEventListener('click', (e) => {
                if (e.target === editOfferModal) {
                    editOfferModal.style.display = "none";
                }
            });

            closeModal.addEventListener("click", () => {
                editOfferModal.style.display = "none";
            });
        });
    </script>
</body>

</html>