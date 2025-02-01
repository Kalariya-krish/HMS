<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/register_style.css">
</head>

<body>
    <?php
    include_once('header.php');
    ?>

    <div class="container" style="margin-top: 100px; margin-bottom:100px;">
        <form method="POST" class="register-form" id="register-form">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-4">
                    <h2 class="form-title">Sign up</h2>
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" placeholder="Your Name" />
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email" />
                    </div>
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="pass" id="pass" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                    </div>
                </div>
                <div class="col-4">
                    <figure><img src="assets/images/about/about-1.jpg" alt="sing up image" style="height:300px;"></figure>
                    <a href=" login.php" class="signup-image-link">Already Have an Account ?</a>
                </div>
                <div class="col-2"></div>
            </div>
        </form>
    </div>

    <?php
    include('footer.php');
    ?>

    <!-- JS -->
    <script src="assets/js/jquery.min.js"></script>
</body>

</html>