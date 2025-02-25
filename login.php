<?php
session_start();

include_once('header.php');
include_once('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data from the database
    $sql = "SELECT id, fullname, email, password, status FROM users WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if ($password === $row['password']) { // Use password_verify() if passwords are hashed
            // Check if status is active
            if ($row['status'] == 'active') {
                // Set session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['email'] = $row['email'];

                // Redirect to user_index.php
                header("Location: user/user_index.php");
                exit();
            } else {
                $alert_message = 'Your account is inactive. Please contact the administrator.';
                $alert_type = 'danger';
            }
        } else {
            $alert_message = 'Invalid email or password.';
            $alert_type = 'danger';
        }
    } else {
        $alert_message = 'Invalid email or password.';
        $alert_type = 'danger';
    }

    // Close the connection
    $con->close();
}
?>

<section><br><br>
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-6">
                <?php if (!empty($alert_message)) : ?>
                    <div class="alert alert-<?php echo $alert_type; ?> alert-dismissible fade show" role="alert">
                        <?php echo $alert_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Login Here</h2>

                        <form id="loginform" name="loginform" method="post">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email"><i class="fa fa-envelope"></i> Email</label>
                                <input type="email" id="email" name="email" class="form-control" required />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="password"><i class="fa fa-lock"></i> Password</label>
                                <input type="password" id="password" name="password" class="form-control" required />
                            </div>

                            <a href="forget_password.php" class="fw-bold text-body"><u>Forget Password</u></a>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success btn-md" style="background-color:rgb(0, 103, 193);">Login</button>
                            </div>

                            <p class="text-center text-muted mt-4">Don't have an account?
                                <a href="register.php" class="fw-bold text-body"><u>Register here</u></a>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section><br><br>

<?php
include('footer.php');
?>

<!-- JS -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        $("#loginform").submit(function(e) {
            e.preventDefault();
            if ($('#loginform').valid()) {
                this.submit();
            }
        });

        $('#loginform').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 20
                }
            },
            messages: {
                email: {
                    required: "Email is required",
                    email: "Enter a valid email"
                },
                password: {
                    required: "Password is required",
                    minlength: "Password must be at least 8 characters",
                    maxlength: "Password cannot exceed 20 characters"
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