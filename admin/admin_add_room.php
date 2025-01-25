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
                                    <form class="form-sample">
                                        <p class="card-description"> Room Details </p>
                                        <div class="row">
                                            <!-- Room Number -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Enter room number" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Room Type -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Room Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" required>
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
                                                        <input type="number" class="form-control" placeholder="Enter price per night" step="0.01" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Number of Beds -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">No. of Beds</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" placeholder="Enter number of beds" required>
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
                                                        <select class="form-select" required>
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
                                                        <input type="file" class="form-control" accept="image/*" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Add Room</button>
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
</body>

</html>