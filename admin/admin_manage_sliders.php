<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Slider</title>
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
                                    <h4 class="card-title">Manage Home Page Slider</h4>
                                    <form class="form-sample" action="upload_slider.php" method="POST" enctype="multipart/form-data" id="addSlider">
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
                                                    <label class="col-sm-3 col-form-label">Upload Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" name="slider_image" accept="image/*">
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
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Fetch slider images from database
                                                // include 'db_connection.php';
                                                // $query = "SELECT * FROM slider";
                                                // $result = mysqli_query($conn, $query);
                                                // while ($row = mysqli_fetch_assoc($result)) {
                                                //     echo "<tr>";
                                                //     echo "<td><img src='uploads/" . $row['image_path'] . "' alt='Slider Image' width='100'></td>";
                                                //     echo "<td>" . $row['title'] . "</td>";
                                                //     echo "<td>
                                                //             <a href='edit_slider.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>Edit</a>
                                                //             <a href='delete_slider.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                                //         </td>";
                                                //     echo "</tr>";
                                                // }
                                                ?>
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




    <script>
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