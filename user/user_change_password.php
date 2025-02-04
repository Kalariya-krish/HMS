<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Change Password">
    <meta name="keywords" content="password, update, change">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
</head>

<body>
    <?php
    include_once('user_header.php');
    ?>

    <section><br><br>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Change Password</h2>

                            <form id="changepasswordform" name="changepasswordform" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="current_password"><i class="fa fa-lock"></i> Current Password</label>
                                    <input type="password" id="current_password" name="current_password" class="form-control" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="new_password"><i class="fa fa-lock"></i> New Password</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="confirm_password"><i class="fa fa-lock"></i> Confirm New Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-md" style="background-color: #0B032D;">Change Password</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>

    <?php
    include('user_footer.php');
    ?>



    <!-- JS -->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#changepasswordform").submit(function(e) {
                e.preventDefault();
                if ($('#changepasswordform').valid()) {
                    alert('Password changed successfully');
                    this.submit();
                }
            });

            $('#changepasswordform').validate({
                rules: {
                    current_password: {
                        required: true,
                        minlength: 8,
                        maxlength: 20
                    },
                    new_password: {
                        required: true,
                        minlength: 8,
                        maxlength: 20
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#new_password"
                    }
                },
                messages: {
                    current_password: {
                        required: "Current password is required",
                        minlength: "Password must be at least 8 characters",
                        maxlength: "Password cannot exceed 20 characters"
                    },
                    new_password: {
                        required: "New password is required",
                        minlength: "Password must be at least 8 characters",
                        maxlength: "Password cannot exceed 20 characters"
                    },
                    confirm_password: {
                        required: "Confirm password is required",
                        equalTo: "Passwords do not match"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>