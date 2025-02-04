<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>

</head>

<body>
    <?php
    include_once('header.php');
    ?>

    <section><br><br>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-6">
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

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-md" style="background-color: #0B032D;">Login</button>
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
                    alert('Login successful');
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
</body>

</html>