<?php
include_once('../db_connection.php');
include_once('../auth_check.php');
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
</head>

<body>
    <?php
    include_once('user_header.php');
    ?>

    <div class="container py-5">
        <!-- Breadcrumb Section Begin -->
        <div class="page-title text-center">
            <h1>About</h1>
            <p class="overlay-text">Our Story</p>
        </div>
        <!-- Breadcrumb Section End -->

        <!-- About Us Page Section Begin -->
        <section class="aboutus-page-section spad">
            <div class="container">
                <div class="about-page-text">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ap-title">
                                <h2>Welcome To Astoria.</h2>
                                <p class="f-para">Astoria Hotel offers a seamless and luxurious booking experience. Whether you’re traveling for business or leisure, our world-class hospitality ensures your stay is unforgettable.</p>
                                <p class="s-para">With modern amenities, comfortable accommodations, and exclusive offers, we make sure every moment of your stay is exceptional. Book with us today and experience elegance at its finest.</p>
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <ul class="ap-services">
                                <li><i class="icon_check"></i> Easy & Secure Online Booking</li>
                                <li><i class="icon_check"></i> Best Price Guarantee</li>
                                <li><i class="icon_check"></i> Complimentary Breakfast</li>
                                <li><i class="icon_check"></i> High-Speed Free WiFi</li>
                                <li><i class="icon_check"></i> 24/7 Customer Support</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="about-page-services">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="ap-service-item set-bg" data-setbg="../assets/images/about/about-p1.jpg">
                                <div class="api-text">
                                    <h3>Restaurants Services</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ap-service-item set-bg" data-setbg="../assets/images/about/about-p2.jpg">
                                <div class="api-text">
                                    <h3>Travel & Camping</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ap-service-item set-bg" data-setbg="../assets/images/about/about-p3.jpg">
                                <div class="api-text">
                                    <h3>Event & Party</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us Page Section End -->

        <!-- Gallery Section Begin -->
        <section class="gallery-section spad">
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
                    <div class="col-lg-6">
                        <div class="gallery-item set-bg" data-setbg="../assets/images/gallery/gallery-1.jpg">
                            <div class="gi-text">
                                <h3>Room Luxury</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="gallery-item set-bg" data-setbg="../assets/images/gallery/gallery-3.jpg">
                                    <div class="gi-text">
                                        <h3>Room Luxury</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="gallery-item set-bg" data-setbg="../assets/images/gallery/gallery-4.jpg">
                                    <div class="gi-text">
                                        <h3>Room Luxury</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="gallery-item large-item set-bg" data-setbg="../assets/images/gallery/gallery-2.jpg">
                            <div class="gi-text">
                                <h3>Room Luxury</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Gallery Section End -->
    </div>
    <?php
    include_once('user_footer.php');
    ?>
    <script>
        $('.set-bg').each(function() {
            var bg = $(this).data('setbg');
            $(this).css('background-image', 'url(' + bg + ')');
        });
    </script>
</body>

</html>