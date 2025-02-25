<?php
include '../db_connection.php';

// Handle Insert or Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $slider_id = isset($_POST['slider_id']) ? $_POST['slider_id'] : null;
    $slider_title = mysqli_real_escape_string($con, $_POST['slider_title']);
    $slider_description = mysqli_real_escape_string($con, $_POST['slider_description']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Handle file upload
    $slider_image = null;
    if (!empty($_FILES['slider_image']['name'])) {
        $slider_image = uniqid() . '_' . $_FILES['slider_image']['name'];
        $target_dir = "../assets/images/sliders/";
        $target_file = $target_dir . $slider_image;

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        move_uploaded_file($_FILES['slider_image']['tmp_name'], $target_file);
    }

    if ($slider_id) {
        // Update existing slider
        if ($slider_image) {
            $query = "UPDATE sliders SET slider_title='$slider_title', slider_description='$slider_description', 
                      slider_image='$slider_image', status='$status' WHERE id='$slider_id'";
        } else {
            $query = "UPDATE sliders SET slider_title='$slider_title', slider_description='$slider_description', 
                      status='$status' WHERE id='$slider_id'";
        }
    } else {
        // Insert new slider
        $query = "INSERT INTO sliders (slider_title, slider_description, slider_image, status, created_at) 
                  VALUES ('$slider_title', '$slider_description', '$slider_image', '$status', NOW())";
    }

    if (mysqli_query($con, $query)) {
        header("Location: admin_manage_sliders.php?success=Slider saved successfully");
    } else {
        header("Location: admin_manage_sliders.php?error=Failed to save slider");
    }
    exit();
}

// Handle Status Update
if (isset($_GET['status_id']) && isset($_GET['status'])) {
    $slider_id = $_GET['status_id'];
    $new_status = $_GET['status'];

    $update_status_query = "UPDATE sliders SET status='$new_status' WHERE id='$slider_id'";
    if (mysqli_query($con, $update_status_query)) {
        header("Location: admin_manage_sliders.php?success=Status updated successfully");
    } else {
        header("Location: admin_manage_sliders.php?error=Failed to update status");
    }
    exit();
}


// Fetch existing sliders
$query = "SELECT * FROM sliders ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Slider</title>
    <link rel="stylesheet" href="../assets/css/admin_editform_style.css">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
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
                                    <h4 class="card-title">Manage Home Page Slider</h4>
                                    <form class="form-sample" action="" method="POST" enctype="multipart/form-data" id="addSlider">
                                        <p class="card-description"> Add New Slider Image </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Slider Title</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="slider_title" placeholder="Enter slider title">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="slider_description" placeholder="Enter slider description" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Upload Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" name="slider_image" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="status">
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Slider</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Existing Slider Images</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Created At</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><img src="../assets/images/sliders/<?php echo $row['slider_image']; ?>" class="img-fluid rounded" width="80"></td>
                                                        <td><?php echo $row['slider_title']; ?></td>
                                                        <td><?php echo ucfirst($row['slider_description']); ?></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <td>
                                                            <a href="?status_id=<?php echo $row['id']; ?>&status=<?php echo ($row['status'] == 'Active') ? 'Inactive' : 'Active'; ?>"
                                                                class="btn btn-sm btn-<?php echo ($row['status'] == 'Active') ? 'success' : 'danger'; ?>">
                                                                <i class="fas fa-toggle-<?php echo ($row['status'] == 'Active') ? 'on' : 'off'; ?>"></i>
                                                                <?php echo $row['status']; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm edit-btn" data-slider='<?php echo json_encode($row); ?>'><i class="fas fa-pen"></i> Edit</button>
                                                            <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
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

    <!-- Edit Modal Start -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-sample" id="editSlider" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="slider_id" id="edit_slider_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Slider Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="slider_title" id="edit_slider_title" placeholder="Enter slider title">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="slider_description" id="edit_slider_description" placeholder="Enter slider description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Current Image</label>
                                    <div class="col-sm-9">
                                        <img id="current_slider_image" src="" alt="Current Slider" class="img-fluid rounded" style="max-height: 100px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Upload New Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="slider_image" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="status" id="edit_status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal End -->

    <script>
        // JavaScript to handle edit functionality
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", () => {
                const sliderData = JSON.parse(button.getAttribute("data-slider"));
                const modal = new bootstrap.Modal(document.getElementById('editModal'));

                // Populate the form fields
                document.getElementById("edit_slider_id").value = sliderData.id;
                document.getElementById("edit_slider_title").value = sliderData.slider_title;
                document.getElementById("edit_slider_description").value = sliderData.slider_description;
                document.getElementById("edit_status").value = sliderData.status;

                // Update the current image
                const currentImage = document.getElementById("current_slider_image");
                currentImage.src = "../assets/images/sliders/" + sliderData.slider_image;

                // Show the modal
                modal.show();
            });
        });

        // Close modal
        document.getElementById("closeModal").addEventListener("click", () => {
            document.getElementById("editModal").style.display = "none";
        });


        $(document).ready(function() {
            // Custom method for file size validation (max 2MB)
            $.validator.addMethod("filesize", function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, "File size must be less than 2MB");

            $("#addSlider").validate({
                rules: {
                    slider_title: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    slider_description: {
                        required: true,
                        minlength: 10,
                    },
                    slider_image: {
                        required: true,
                        extension: "jpg|jpeg|png",
                        filesize: 2097152 // 2MB
                    }
                },
                messages: {
                    slider_title: {
                        required: "Please enter a slider title",
                        minlength: "Title must be at least 3 characters",
                        maxlength: "Title cannot exceed 50 characters"
                    },
                    slider_description: {
                        required: "Please enter a slider description",
                        minlength: "Description must be at least 10 characters"
                    },
                    slider_image: {
                        required: "Please upload an image",
                        extension: "Only JPG, JPEG, and PNG formats are allowed",
                        filesize: "File size must be less than 2MB"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });

            // Prevent form submission if validation fails
            $("#addSlider").submit(function(e) {
                if (!$(this).valid()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>