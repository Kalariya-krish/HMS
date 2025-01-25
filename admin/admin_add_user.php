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
                                    <h4 class="card-title">Add User</h4>
                                    <form class="form-sample">
                                        <p class="card-description"> User Details </p>
                                        <div class="row">
                                            <!-- Username -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="Enter username" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control" placeholder="Enter email" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Password -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" placeholder="Enter password" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" placeholder="Confirm password" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Role -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Role</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" required>
                                                            <option value="" disabled selected>Select Role</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="manager">Manager</option>
                                                            <option value="staff">Staff</option>
                                                            <option value="guest">Guest</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-select" required>
                                                            <option value="" disabled selected>Select Status</option>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                            <option value="banned">Banned</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="card-description"> Profile Picture </p>
                                        <div class="row">
                                            <!-- Profile Picture -->
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Upload Picture</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" accept="image/*" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Add User</button>
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