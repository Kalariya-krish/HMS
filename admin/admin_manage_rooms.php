<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Handle Room Update
if (isset($_POST['update_room'])) {
    $room_no = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $beds = $_POST['beds'];
    $status = $_POST['room_status'];
    $features = implode(', ', $_POST['features'] ?? []);

    $image_name = $_POST['current_image'];
    if (!empty($_FILES['room_image']['name'])) {
        $image_name = uniqid() . "_" . $_FILES['room_image']['name'];
        move_uploaded_file($_FILES['room_image']['tmp_name'], "../assets/images/rooms/$image_name");
    }

    $query = "UPDATE rooms SET room_type='$room_type', room_price='$price', no_of_beds='$beds', room_status='$status', room_features='$features', room_image='$image_name' WHERE room_no='$room_no'";
    mysqli_query($con, $query);
    header("Location: manage_rooms.php");
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
        echo "<script>alert('Room deleted successfully!'); window.location='admin_manage_rooms.php';</script>";
    } else {
        echo "<script>alert('Error deleting room!');</script>";
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
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <?php include 'admin_sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
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
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><img src="../assets/images/rooms/<?php echo $row['image']; ?>" class="img-fluid rounded" width="80"></td>
                                                <td><?php echo $row['room_no']; ?></td>
                                                <td><?php echo ucfirst($row['room_type']); ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td><?php echo $row['bed']; ?></td>
                                                <td><?php echo $row['services']; ?></td>
                                                <td>
                                                    <a href="?status_id=<?php echo $row['room_no']; ?>&status=<?php echo ($row['room_status'] == 'Available') ? 'Booked' : 'Available'; ?>" class="btn btn-sm btn-<?php echo ($row['room_status'] == 'Available') ? 'success' : 'danger'; ?>">
                                                        <i class="fas fa-toggle-<?php echo ($row['room_status'] == 'Available') ? 'on' : 'off'; ?>"></i>
                                                        <?php echo ucfirst($row['room_status']); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-sm edit-btn" data-room='<?php echo json_encode($row); ?>'>
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <a href="?delete_id=<?php echo $row['room_no']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
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

        <!-- Edit Modal Start -->
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
                                    <input type="text" class="form-control" name="size" id="editSize">
                                </div>
                            </div>
                        </div>
                        <!-- Price per Night -->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Capacity</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="capacity" id="editCapacity">
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
                                    <img id="roomImagePreview" src="../assets/images/room/room-1.jpg" alt="Room Image Preview" style="border-radius: 20%; height:100px; width:150px;"><br><br>
                                    <input type="hidden" id="currentImage" name="current_image">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                </form>
            </div>
        </div>
        <!-- Edit Modal End -->

       <script>
document.querySelectorAll('.edit-btn').forEach(button => {
  button.addEventListener('click', () => {
    try {
      const data = JSON.parse(button.getAttribute('data-room'));

      // Set form values
      document.getElementById('editRoomNumber').value = data.room_no;
      document.getElementById('editRoomName').value = data.room_name || '';
      document.getElementById('editRoomType').value = data.room_type;
      document.getElementById('editPrice').value = data.room_price;
      document.getElementById('editSize').value = data.size || '';
      document.getElementById('editCapacity').value = data.capacity || '';
      document.getElementById('editBeds').value = data.no_of_beds;
      document.getElementById('editStatus').value = data.room_status;
      document.getElementById('editDescription').value = data.description || '';
      document.getElementById('currentImage').value = data.room_image;

      // Show room image
      const imagePath = `../assets/images/rooms/${data.room_image}`;
      document.getElementById('roomImagePreview').src = imagePath;

      // Open the modal
      document.getElementById('editModal').style.display = 'flex';
    } catch (error) {
      console.error('Error loading room data:', error);
    }
  });
});

// Close Modal
document.getElementById('closeModal').addEventListener('click', () => {
  document.getElementById('editModal').style.display = 'none';
});
</script>

</body>

</html>