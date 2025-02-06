<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
</head>

<body>
    <?php include_once('header.php'); ?>

    <section><br><br>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Forgot Password</h2>

                            <form id="forgotPasswordForm" name="forgotPasswordForm" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email"><i class="fa fa-envelope"></i> Enter Your Registered Email</label>
                                    <input type="email" id="email" name="email" class="form-control" required />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-md" style="background-color:rgb(0, 103, 193);">Reset Password</button>
                                </div>

                                <p class="text-center text-muted mt-4">
                                    Remember your password?
                                    <a href="login.php" class="fw-bold text-body"><u>Login here</u></a>
                                </p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>

    <?php include('footer.php'); ?>

    <!-- JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#forgotPasswordForm").submit(function(e) {
                e.preventDefault();
                if ($('#forgotPasswordForm').valid()) {
                    alert('Password reset link sent to your email');
                    this.submit();
                }
            });

            $('#forgotPasswordForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: "Email is required",
                        email: "Enter a valid email"
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
        });
    </script>
</body>

</html>