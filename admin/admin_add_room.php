<?php
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $room_no = mysqli_real_escape_string($con, $_POST['room_number']);
    $room_type = mysqli_real_escape_string($con, $_POST['room_type']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $beds = mysqli_real_escape_string($con, $_POST['beds']);
    $status = mysqli_real_escape_string($con, $_POST['room_status']);

    // Handle features array
    $features = isset($_POST['features']) ? $_POST['features'] : array();
    $features_string = mysqli_real_escape_string($con, implode(', ', $features));

    // Handle file upload
    $image_name = '';
    if (isset($_FILES['room_image'])) {
        $image_name = uniqid() . '_' . $_FILES['room_image']['name'];
        $upload_path = "../assets/images/rooms/" . $image_name;
        move_uploaded_file($_FILES['room_image']['tmp_name'], $upload_path);
    }

    // Check if room number already exists
    $check_query = "SELECT room_no FROM rooms WHERE room_no = '$room_no'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Room number already exists!'); window.location='admin_add_room.php';</script>";
        exit();
    }

    // Insert query
    $query = "INSERT INTO rooms (room_no, room_type, room_price, no_of_beds, room_status, room_features, room_image) 
              VALUES ('$room_no', '$room_type', '$price', '$beds', '$status', '$features_string', '$image_name')";

    // Execute query
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Room added successfully!'); window.location='admin_manage_rooms.php';</script>";
    } else {
        echo "<script>alert('Error adding room: " . mysqli_error($con) . "'); window.location='add_room.php';</script>";
    }

    mysqli_close($con);
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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add Room</h4>
                                    <form class="form-sample" id="addroom" enctype="multipart/form-data" method="POST">
                                        <p class="card-description"> Room Details </p>
                                        <div class="row">
                                            <!-- Room Number -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Enter room number" name="room_number">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Room Type -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" name="room_type">
                                                            <option value="" disabled selected>Select Room Type</option>
                                                            <option value="single">Single</option>
                                                            <option value="double">Double</option>
                                                            <option value="suite">Suite</option>
                                                            <option value="deluxe">Deluxe</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Price per Night -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Price ($)</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Enter price per night" step="0.01" name="price">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Number of Beds -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">No. of Beds</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Enter number of beds" name="beds">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Room Status -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" name="room_status">
                                                            <option value="" disabled selected>Select Status</option>
                                                            <option value="available">Available</option>
                                                            <option value="occupied">Occupied</option>
                                                            <option value="maintenance">Under Maintenance</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <p class="card-description"> Features </p>
                                        <div class="row">
                                            <!-- Room Features -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Features</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" value="ac" name="features[]"> Air Conditioning <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" value="wifi" name="features[]"> Wi-Fi <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" value="tv" name="features[]"> TV <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" value="minibar" name="features[]"> Mini Bar <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Room Image -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" accept="image/*" name="room_image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" style="background-color:rgb(0, 103, 193);">Add Room</button>
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

            $('#addroom').validate({
                rules: {
                    room_number: {
                        required: true,
                        digits: true,
                        minlength: 1,
                        maxlength: 4
                    },
                    room_type: {
                        required: true
                    },
                    price: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    beds: {
                        required: true,
                        digits: true,
                        min: 1,
                        max: 10
                    },
                    room_status: {
                        required: true
                    },
                    room_image: {
                        required: true,
                        extension: "jpg|jpeg|png",
                        filesize: 2097152 // 2MB
                    }
                },
                messages: {
                    room_number: {
                        required: "Room number is required",
                        digits: "Only numeric values are allowed",
                        minlength: "Room number must be at least 1 digit",
                        maxlength: "Room number cannot exceed 4 digits"
                    },
                    room_type: {
                        required: "Please select a room type"
                    },
                    price: {
                        required: "Price is required",
                        number: "Enter a valid number",
                        min: "Price must be greater than $0"
                    },
                    beds: {
                        required: "Number of beds is required",
                        digits: "Only numeric values are allowed",
                        min: "At least one bed is required",
                        max: "Cannot exceed 10 beds"
                    },
                    room_status: {
                        required: "Please select room status"
                    },
                    room_image: {
                        required: "Room image is required",
                        extension: "Only JPG, JPEG, PNG files are allowed",
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
            $('#addroom').submit(function(e) {
                if (!$(this).valid()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>