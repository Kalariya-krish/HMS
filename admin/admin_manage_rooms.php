<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle Room Update
if (isset($_POST['update_room'])) {
    $room_no = $_POST['room_number'];
    $room_name = $_POST['room_name'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $capacity = $_POST['capacity'];
    $beds = $_POST['beds'];
    $status = $_POST['room_status'];
    $description = $_POST['description'];
    $services = implode(', ', $_POST['services'] ?? []);

    $image_name = $_POST['current_image'];
    if (!empty($_FILES['room_image']['name'])) {
        $old_image_path = "../assets/images/rooms/" . $image_name;
        if (file_exists($old_image_path) && !empty($image_name)) {
            unlink($old_image_path);
        }
        $image_name = uniqid() . "_" . $_FILES['room_image']['name'];
        move_uploaded_file($_FILES['room_image']['tmp_name'], "../assets/images/rooms/$image_name");
    }

    // Update query
    $query = "UPDATE rooms SET room_name = '$room_name',room_type = '$room_type',price = '$price',
    size = '$size',capacity = '$capacity',bed = '$beds',room_status = '$status',description = '$description',services = '$services',image = '$image_name'
              WHERE room_no = '$room_no'";
    mysqli_query($con, $query);
    header("Location: admin_manage_rooms.php");
    exit();
}

// Handle Room Deletion
if (isset($_GET['delete_id'])) {
    $room_no = $_GET['delete_id'];

    // Delete related bookings first
    $deleteBookings = "DELETE FROM bookings WHERE room_no = '$room_no'";
    mysqli_query($con, $deleteBookings);

    // Now delete the room
    $deleteRoom = "DELETE FROM rooms WHERE room_no = '$room_no'";
    if (mysqli_query($con, $deleteRoom)) {
        header("Location: admin_manage_rooms.php?success=Room deleted successfully!");
        exit();
    } else {
        header("Location: admin_manage_rooms.php?error=Error deleting room!");
        exit();
    }
}


// Handle Status Change
if (isset($_GET['status_id']) && isset($_GET['status'])) {
    $room_no = $_GET['status_id'];
    $new_status = $_GET['status'];
    mysqli_query($con, "UPDATE rooms SET room_status='$new_status' WHERE room_no='$room_no'");
    header("Location: admin_manage_rooms.php");
    exit();
}

// Fetch Rooms Data
$result = mysqli_query($con, "SELECT * FROM rooms");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="../assets/css/admin_editform_style.css">
    <style>
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            overflow: auto;
            padding: 50px 0;
            /* Adds space from top and bottom */
        }

        .popup-card {
            background: white;
            width: 60%;
            max-height: 80vh;
            /* Limits height */
            overflow-y: auto;
            /* Makes content scrollable */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
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
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><img src="../assets/images/rooms/<?php echo $row['image']; ?>" class="img-fluid rounded" width="80"></td>
                                                <td><?php echo $row['room_no']; ?></td>
                                                <td><?php echo ucfirst($row['room_type']); ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td>
                                                    <a href="?status_id=<?php echo $row['room_no']; ?>&status=<?php echo ($row['room_status'] == 'Available') ? 'Booked' : 'Available'; ?>" class="btn btn-sm btn-<?php echo ($row['room_status'] == 'Available') ? 'success' : 'danger'; ?>">
                                                        <i class="fas fa-toggle-<?php echo ($row['room_status'] == 'Available') ? 'on' : 'off'; ?>"></i>
                                                        <?php echo ucfirst($row['room_status']); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm view-btn"
                                                        data-room_no="<?php echo $row['room_no']; ?>"
                                                        data-name="<?php echo htmlspecialchars($row['room_name']); ?>"
                                                        data-type="<?php echo htmlspecialchars($row['room_type']); ?>"
                                                        data-price="<?php echo $row['price']; ?>"
                                                        data-size="<?php echo $row['size']; ?>"
                                                        data-capacity="<?php echo $row['capacity']; ?>"
                                                        data-beds="<?php echo $row['bed']; ?>"
                                                        data-status="<?php echo $row['room_status']; ?>"
                                                        data-description="<?php echo $row['description']; ?>"
                                                        data-services="<?php echo $row['services']; ?>"
                                                        data-image="<?php echo $row['image']; ?>">
                                                        <i class="fas fa-eye"></i>View
                                                    </button>
                                                    <button class="btn btn-info btn-sm edit-btn" data-room='<?php echo json_encode($row); ?>'>
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <a href="?delete_id=<?php echo $row['room_no']; ?>" class="btn btn-danger btn-sm">
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


        <!-- Room View Modal -->
        <div class="overlay" id="roomModal">
            <div class="popup-card">
                <h4 class="card-title">Room Details</h4>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Room No:</strong> <span id="modalRoomNo"></span></p>
                        <p><strong>Room Name:</strong> <span id="modalRoomName"></span></p>
                        <p><strong>Room Type:</strong> <span id="modalRoomType"></span></p>
                        <p><strong>Price:</strong> $<span id="modalPrice"></span></p>
                        <p><strong>Size:</strong> <span id="modalSize"></span></p>
                        <p><strong>Capacity:</strong> <span id="modalCapacity"></span></p>
                        <p><strong>Beds:</strong> <span id="modalBeds"></span></p>
                        <p><strong>Status:</strong> <span id="modalRoomStatus"></span></p>
                        <p><strong>Description:</strong> <span id="modalDescription"></span></p>
                        <p><strong>Services:</strong> <span id="modalServices"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Image:</strong><br>
                            <img id="modalRoomImage" src="" alt="Room Image" onerror="this.src='placeholder.jpg'" style="width:100%; max-width:300px; border-radius:10px; margin-top:5px;">
                        </p>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" id="closeRoomModal">Close</button>
            </div>
        </div>


        <!-- Edit Modal Start -->
        <div class="overlay" id="editModal">
            <div class="popup-card">
                <h4 class="card-title">Edit Room</h4><br><br>
                <form class="form-sample" id="editForm" method="POST" enctype="multipart/form-data">
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
                        <!-- Room Name -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Room Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="room_name" id="editRoomName">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
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
                        <!-- Price per Night -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Price ($)</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="price" id="editPrice">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Room Type -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Room size</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="size" class="form-control" id="editSize" placeholder="Enter room size" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <span class="input-group-text" id="basic-addon2"> .ft</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Price per Night -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Capacity</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="capacity" id="editCapacity" class="form-control" placeholder="Enter room capacity" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <span class="input-group-text" id="basic-addon2"> Person</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Number of Beds -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">No. of Beds</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="beds" id="editBeds">
                                </div>
                            </div>
                        </div>
                        <!-- Room Status -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Room Status</label>
                                <div class="col-sm-8 text-black">
                                    <select class="form-select" name="room_status" id="editStatus">
                                        <option value="Available">Available</option>
                                        <option value="Booked">Booked</option>
                                        <option value="Maintenance">Maintenance</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Number of Beds -->
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Room Description</label>
                                <div class="col-sm-8">
                                    <textarea name="description" id="editDescription" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Room Features -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Room Services</label>
                                <div class="col-sm-8">
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
                                <label class="col-sm-4 col-form-label">Room Image</label>
                                <div class="col-sm-8">
                                    <img id="roomImagePreview" src="../assets/images/room/room-1.jpg" alt="Room Image Preview" style="border-radius: 20%; height:100px; width:150px;"><br><br>
                                    <input type="hidden" id="currentImage" name="current_image">
                                    <input type="file" name="room_image" class="form-control" accept="image/*">

                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="update_room" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                </form>
            </div>
        </div>
        <!-- Edit Modal End -->

        <script>
            // Room view button click
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', () => {
                    document.getElementById('modalRoomNo').textContent = button.dataset.room_no;
                    document.getElementById('modalRoomName').textContent = button.dataset.name;
                    document.getElementById('modalRoomType').textContent = button.dataset.type;
                    document.getElementById('modalPrice').textContent = button.dataset.price;
                    document.getElementById('modalSize').textContent = button.dataset.size;
                    document.getElementById('modalCapacity').textContent = button.dataset.capacity;
                    document.getElementById('modalBeds').textContent = button.dataset.beds;
                    document.getElementById('modalRoomStatus').textContent = button.dataset.status;
                    document.getElementById('modalDescription').textContent = button.dataset.description;
                    document.getElementById('modalServices').textContent = button.dataset.services;
                    document.getElementById('modalRoomImage').src = '../assets/images/rooms/' + button.dataset.image;

                    document.getElementById('roomModal').style.display = 'flex';
                });
            });

            // Close room modal
            document.getElementById('closeRoomModal').addEventListener('click', () => {
                document.getElementById('roomModal').style.display = 'none';
            });


            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', () => {
                    try {
                        const data = JSON.parse(button.getAttribute('data-room'));

                        console.log("Loaded Room Data:", data); // Debugging

                        // Extract number only from 'size' and 'capacity'
                        const sizeNumber = data.size.replace(/\D/g, '');
                        const capacityNumber = data.capacity.replace(/\D/g, '');

                        // Set form values
                        document.getElementById('editRoomNumber').value = data.room_no;
                        document.getElementById('editRoomName').value = data.room_name;
                        document.getElementById('editRoomType').value = data.room_type;
                        document.getElementById('editPrice').value = data.price;
                        document.getElementById('editSize').value = sizeNumber;
                        document.getElementById('editCapacity').value = capacityNumber;
                        document.getElementById('editBeds').value = data.bed;
                        document.getElementById('editStatus').value = data.room_status;
                        document.getElementById('editDescription').value = data.description;
                        document.getElementById('currentImage').value = data.image;

                        // Update Room Image
                        document.getElementById('roomImagePreview').src = `../assets/images/rooms/${data.image}`;

                        // Set room services (features)
                        const services = data.services.split(',').map(s => s.trim().toLowerCase());
                        document.querySelectorAll('#editForm input[type="checkbox"]').forEach(checkbox => {
                            checkbox.checked = services.includes(checkbox.value.toLowerCase());
                        });

                        // Open modal
                        document.getElementById('editModal').style.display = 'flex';
                    } catch (error) {
                        console.error("Error parsing room data:", error);
                    }
                });
            });

            // Close modal
            document.getElementById("closeModal").addEventListener("click", () => {
                document.getElementById("editModal").style.display = "none";
            });
        </script>

</body>

</html>