<?php
include_once('../db_connection.php');
include_once('../auth_check.php');

// Fetch About Us Data
$sql = "SELECT * FROM about_us WHERE id = 1";
$result = mysqli_query($con, $sql);
$about = mysqli_fetch_assoc($result);

// Decode JSON Services & Gallery
$services = json_decode($about['services'], true);
$gallery_images = json_decode($about['gallery_images'], true);
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
</head>

<body>
    <?php include_once('user_header.php'); ?>

    <div class="container py-5">
        <div class="page-title text-center">
            <h1>About</h1>
            <p class="overlay-text">Our Story</p>
        </div>

        <section class="aboutus-page-section spad">
            <div class="container">
                <div class="about-page-text">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ap-title">
                                <h2><?php echo $about['title']; ?></h2>
                                <p class="f-para"><?php echo $about['description']; ?></p>
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <ul class="ap-services">
                                <?php foreach ($services as $service): ?>
                                    <li><i class="icon_check"></i><?php echo $service; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="gallery-section spad">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title">
                                    <span>Our Gallery</span>
                                    <h2>Discover Our Work</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($gallery_images as $image): ?>
                                <div class="col-md-4">
                                    <div class="gallery-item set-bg" data-setbg="../<?php echo $image; ?>">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include_once('user_footer.php'); ?>

    <script>
        document.querySelectorAll('.set-bg').forEach(function(element) {
            let bg = element.getAttribute('data-setbg');
            element.style.backgroundImage = 'url(' + bg + ')';
        });
    </script>
</body>

</html>