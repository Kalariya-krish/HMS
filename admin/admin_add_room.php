<?php
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $room_no = $_POST['room_number'];
    $room_name = $_POST['room_name'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $size = $_POST['size'] . '.ft';
    $capacity = $_POST['capacity'] . ' Persons';
    $beds = $_POST['beds'];
    $status = $_POST['room_status'];
    $description = $_POST['description'];

    // Handle features array
    $services = isset($_POST['services']) ? $_POST['services'] : array();
    $services = implode(', ', $services);

    // Handle file upload
    $image_name = '';
    if (isset($_FILES['room_image'])) {
        $image_name = uniqid() . '_' . $_FILES['room_image']['name'];
        $upload_path = "../assets/images/rooms/" . $image_name;
        move_uploaded_file($_FILES['room_image']['tmp_name'], $upload_path);
    }

    // Insert query
    $query = "INSERT INTO rooms (room_no, room_name, room_type, price, size, capacity, bed, room_status, services, description, image) 
              VALUES ('$room_no', '$room_name', '$room_type', '$price', '$size', '$capacity', '$beds', '$status', '$services', '$description','$image_name')";

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
                                                        <div class="roomno_error text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Room name -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Enter room name" name="room_name">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
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

                                            <!-- Price per Night -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Price ($)</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Enter price per night" step="0.01" name="price">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Room size -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Size in foots</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Enter size of the room" name="size">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Room capacity -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Capacity</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Enter room capacity" name="capacity">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Number of Beds -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">No. of Beds</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Enter number of beds" name="beds">
                                                    </div>
                                                </div>
                                            </div>
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

                                        <div class="row">
                                            <!-- Number of Beds -->
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" rows="3" placeholder="Enter room description" name="description"></textarea>
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
                                                                <input type="checkbox" class="form-check-input" value="ac" name="services[]"> Air Conditioning <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" value="wifi" name="services[]"> Wi-Fi <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" value="tv" name="services[]"> TV <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" value="minibar" name="services[]"> Mini Bar <i class="input-helper"></i>
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
            // Custom validator for checking current password via AJAX
        $.validator.addMethod("checkRoomNo", function(value, element) {
            var valid = false;
            $.ajax({
                type: 'GET',
                url: 'check_duplicate_room.php',
                data: {
                    room_no: value
                },
                async: false, // Need synchronous for validator
                success: function(response) {
                    valid = (response == 'false');
                }
            });
            return valid;
        }, "Room no is valid");

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
                        maxlength: 4,
                        checkRoomNo: true
                    },
                    room_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 30
                    },
                    room_type: {
                        required: true
                    },
                    price: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    size: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    capacity: {
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
                    description: {
                        required: true,
                        minlength: 10
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
                        maxlength: "Room number cannot exceed 4 digits",
                        checkRoomNo: "Room already added"
                    },
                    room_name: {
                        required: "Room name is required",
                        minlength: "Room name must be at least 3 character",
                        maxlength: "Room name cannot exceed 30 characters"
                    },
                    room_type: {
                        required: "Please select a room type"
                    },
                    price: {
                        required: "Price is required",
                        number: "Enter a valid number",
                        min: "Price must be greater than $0"
                    },
                    size: {
                        required: "Size is required",
                        number: "Enter a valid number",
                        min: "Size must be greater than 0"
                    },
                    capacity: {
                        required: "Room capacity is required",
                        number: "Enter a valid number",
                        min: "Capacity must be greater than 0"
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
                    description: {
                        required: "Room description is required",
                        minlength: "Room description must be at least 10 characters"
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