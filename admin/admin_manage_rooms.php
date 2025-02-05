    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../assets/css/admin_editform_style.css">
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
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Manage Rooms</h4>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Room Number</th>
                                                        <th>Room Type</th>
                                                        <th>Price ($)</th>
                                                        <th>No. of Beds</th>
                                                        <th>Features</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <img src="https://via.placeholder.com/50" alt="Room Image" class="img-fluid rounded">
                                                        </td>
                                                        <td>101</td>
                                                        <td>Single</td>
                                                        <td>50</td>
                                                        <td>1</td>
                                                        <td>WiFi, TV</td>
                                                        <td><label class="badge badge-success">Available</label></td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm edit-btn" data-room="102" data-type="Double" data-price="80">Edit</button>
                                                            <button class="btn btn-danger btn-sm">Delete</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="https://via.placeholder.com/50" alt="Room Image" class="img-fluid rounded">
                                                        </td>
                                                        <td>102</td>
                                                        <td>Double</td>
                                                        <td>80</td>
                                                        <td>2</td>
                                                        <td>WiFi, TV, AC</td>
                                                        <td><label class="badge badge-warning">Occupied</label></td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm edit-btn" data-room="102" data-type="Double" data-price="80">Edit</button>
                                                            <button class="btn btn-danger btn-sm">Delete</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="https://via.placeholder.com/50" alt="Room Image" class="img-fluid rounded">
                                                        </td>
                                                        <td>103</td>
                                                        <td>Suite</td>
                                                        <td>120</td>
                                                        <td>3</td>
                                                        <td>WiFi, TV, AC, Kitchenette</td>
                                                        <td><label class="badge badge-danger">Under Maintenance</label></td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm edit-btn" data-room="102" data-type="Double" data-price="80">Edit</button>
                                                            <button class="btn btn-danger btn-sm">Delete</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="https://via.placeholder.com/50" alt="Room Image" class="img-fluid rounded">
                                                        </td>
                                                        <td>104</td>
                                                        <td>Deluxe</td>
                                                        <td>150</td>
                                                        <td>2</td>
                                                        <td>WiFi, TV, AC, Balcony</td>
                                                        <td><label class="badge badge-success">Available</label></td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm edit-btn" data-room="102" data-type="Double" data-price="80">Edit</button>
                                                            <button class="btn btn-danger btn-sm">Delete</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="https://via.placeholder.com/50" alt="Room Image" class="img-fluid rounded">
                                                        </td>
                                                        <td>105</td>
                                                        <td>Single</td>
                                                        <td>50</td>
                                                        <td>1</td>
                                                        <td>WiFi</td>
                                                        <td><label class="badge badge-warning">Occupied</label></td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm edit-btn" data-room="102" data-type="Double" data-price="80">Edit</button>
                                                            <button class="btn btn-danger btn-sm">Delete</button>
                                                        </td>
                                                    </tr>
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


            <!-- Edit Modal -->
            <div class="overlay" id="editModal">
                <div class="popup-card">
                    <h4 class="card-title">Edit Room</h4><br><br>
                    <form class="form-sample" id="editForm" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Room Number -->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Room Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="room_number" id="editRoomNumber" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Room Type -->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Room Type</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="room_type" id="editRoomType">
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
                                    <label class="col-sm-4 col-form-label">Price ($)</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="price" id="editPrice">
                                    </div>
                                </div>
                            </div>

                            <!-- Number of Beds -->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">No. of Beds</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="beds" id="editBeds">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Room Status -->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Room Status</label>
                                    <div class="col-sm-8 text-black">
                                        <select class="form-select" name="room_status" id="editStatus">
                                            <option value="available">Available</option>
                                            <option value="occupied">Occupied</option>
                                            <option value="maintenance">Under Maintenance</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Room Features -->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Room Features</label>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="ac"> Air Conditioning <i class="input-helper"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="wifi"> Wi-Fi <i class="input-helper"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="tv"> TV <i class="input-helper"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="minibar"> Mini Bar <i class="input-helper"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Room Image -->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Room Image</label>
                                    <div class="col-sm-8">
                                        <img src="../assets/images/room/room-1.jpg" alt="" style="border-radius: 20%; height:100px; width:150px;"><br><br>
                                        <input type="file" class="form-control" name="room_image">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                    </form>
                </div>
            </div>

            <script>
                const editButtons = document.querySelectorAll(".edit-btn");
                const editModal = document.getElementById("editModal");
                const closeModal = document.getElementById("closeModal");

                editButtons.forEach(button => {
                    button.addEventListener("click", () => {
                        document.getElementById("editRoomNumber").value = button.getAttribute("data-room");
                        document.getElementById("editRoomType").value = button.getAttribute("data-type");
                        document.getElementById("editPrice").value = button.getAttribute("data-price");

                        editModal.style.display = "flex";
                    });
                });

                closeModal.addEventListener("click", () => {
                    editModal.style.display = "none";
                });

                // Close modal when clicking outside the card
                editModal.addEventListener("click", (e) => {
                    if (e.target === editModal) {
                        editModal.style.display = "none";
                    }
                });

                $(document).ready(function() {
                    // Custom file size validation method
                    $.validator.addMethod("filesize", function(value, element, param) {
                        return this.optional(element) || (element.files[0].size <= param);
                    }, "File size must be less than 2MB");

                    $('#editForm').validate({
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
                    $('#editForm').submit(function(e) {
                        if (!$(this).valid()) {
                            e.preventDefault();
                        }
                    });
                });
            </script>
    </body>

    </html>