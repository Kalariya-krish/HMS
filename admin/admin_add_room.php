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
                                    <form class="form-sample" id="addroom" enctype="multipart/form-data">
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