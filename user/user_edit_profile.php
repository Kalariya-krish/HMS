<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Edit Profile">
    <meta name="keywords" content="profile, edit, user">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
</head>

<body>
    <?php
    include_once('user_header.php');
    ?>

    <!-- Edit Profile Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-text">
                        <h2>Update Profile</h2>
                        <p>Ensure your profile details are accurate and up to date.</p>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <form action="update_profile.php" method="POST" enctype="multipart/form-data" class="contact-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="phone" placeholder="Your Phone Number" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="file" name="profile_image" accept="image/*">
                            </div>
                            <div class="col-lg-12">
                                <button type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Edit Profile Section End -->

    <?php
    include('user_footer.php');
    ?>
</body>

</html>