<?php
ob_start();
session_start();
include_once('header.php');
include_once('db_connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, fullname, email, password, role, status, profile_picture FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['status'] == 'active') {
            $_SESSION['id'] = $row['id'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['profile_picture'] = $row['profile_picture'];

            if ($row['role'] == 'guest') {
                $redirect_url = isset($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : "http://localhost/hms/user/user_index.php";
            } elseif ($row['role'] == 'admin') {
                $redirect_url = "http://localhost/hms/admin/admin_dashboard.php";
            }

            unset($_SESSION['redirect_after_login']); // Remove saved redirect
            header("Location: " . $redirect_url);
            exit();
        } else {
            $_SESSION['error'] = "Your account is inactive. Please check your email for activate your account.";
        }
    } else {
        $_SESSION['error'] = "Invalid email or password.";
    }
    header("Location: login.php");
    exit();
}
ob_end_flush();
?>


<section><br><br>
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-6">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Login Here</h2>

                        <form action="login.php" id="loginform" name="loginform" method="post">
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
                                <button type="submit" class="btn btn-success btn-md" style="background-color: #0B032D;" name="login">Login</button>
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
            if ($('#loginform').valid()) {
                return true; // Allow submission
            }
            e.preventDefault(); // Prevent only when validation fails
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