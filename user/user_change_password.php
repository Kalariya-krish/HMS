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

    <!-- Change Password Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-text">
                        <h2>Change Password</h2>
                        <p>Use a strong password to keep your account secure.</p>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <form action="update_password.php" method="POST" class="contact-form">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="password" name="current_password" placeholder="Current Password" required>
                            </div>
                            <div class="col-lg-12">
                                <input type="password" name="new_password" placeholder="New Password" required>
                            </div>
                            <div class="col-lg-12">
                                <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Change Password Section End -->

    <?php
    include('user_footer.php');
    ?>
</body>

</html>