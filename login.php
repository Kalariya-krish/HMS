<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/register_style.css">
</head>

<body>
    <?php
    include_once('header.php');
    ?>

    <!-- Sing in  Form -->
    <div class="container" style="margin-top: 100px; margin-bottom:100px;">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-4">
                <figure><img src="assets/images/about/about-2.jpg" alt="sing up image" style="height:300px;"></figure>
                <a href="register.php" class="signup-image-link">Create an account</a>
            </div>
            <div class="col-4">
                <h2 class="form-title">Sign in</h2>
                <form method="POST" class="register-form" id="login-form">
                    <div class="form-group">
                        <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="your_name" id="your_name" placeholder="Your Name" />
                    </div>
                    <div class="form-group">
                        <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="your_pass" id="your_pass" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                        <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

    <?php
    include('footer.php');
    ?>

    <!-- JS -->
    <script src="assets/js/jquery.min.js"></script>
</body>

</html>