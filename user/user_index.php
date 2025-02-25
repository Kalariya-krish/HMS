<?php
include '../db_connection.php';

$slider_query = "SELECT * FROM sliders WHERE status = 'Active'";
$slider_result = mysqli_query($con, $slider_query);

$room_query = "SELECT * FROM rooms WHERE room_status = 'Available'";
$room_result = mysqli_query($con, $room_query);

$review_query = "SELECT * FROM reviews";
$review_result = mysqli_query($con, $review_query);
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Astoria</title>
</head>

<body>
    <?php
    include_once('user_header.php');
    ?>

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <!-- Default title and description (will be updated dynamically) -->
                        <h1 id="slider-title">Welcome to Astoria</h1>
                        <p id="slider-description">Experience luxury like never before.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <?php
            // Fetch all sliders
            $sliders = [];
            while ($slider = mysqli_fetch_assoc($slider_result)) {
                $sliders[] = $slider; // Store slider data in an array
            }
            ?>
            <?php foreach ($sliders as $index => $slider): ?>
                <div class="hs-item set-bg" data-setbg="../assets/images/sliders/<?php echo $slider['slider_image']; ?>" data-title="<?php echo $slider['slider_title']; ?>" data-description="<?php echo $slider['slider_description']; ?>"></div>
            <?php endforeach; ?>
        </div>
    </section>
    <!-- Hero Section End -->

    <section class="aboutus-section py-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7 order-lg-2">
                    <div class="about-gallery position-relative">
                        <div class="row g-3">
                            <div class="col-md-8 col-12">
                                <img src="../assets/images/about/about1.jpg"
                                    class="img-fluid rounded-4 w-100 h-auto main-image shadow-lg transition-transform duration-300 hover:scale-95"
                                    alt="Astoria Hotel Exterior">
                            </div>
                            <div class="col-md-4 col-12">
                                <img src="../assets/images/about/about2.jpg"
                                    class="img-fluid rounded-4 w-100 h-100 secondary-image shadow-lg transition-transform duration-300 hover:scale-95"
                                    alt="Astoria Hotel Interior">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 order-lg-1">
                    <div class="about-content pe-lg-4 text-center text-lg-start">
                        <div class="section-header mb-4">
                            <span class="text-uppercase font-bold text-blue-800 small mb-2 d-block">Our Story</span>
                            <h2 class="display-6 mb-3">Redefining Hospitality <br>with Passion</h2>
                        </div>
                        <div class="about-details">
                            <p class="lead text-muted mb-4">
                                Astoria Hotel represents the pinnacle of luxury and comfort,
                                offering an unparalleled experience that transforms ordinary
                                stays into extraordinary memories.
                            </p>
                            <div class="feature-list mb-4">
                                <div class="feature-item d-flex align-items-center mb-3">
                                    <div class="icon-box me-3">
                                        <i class="fas fa-check-circle text-primary"></i>
                                    </div>
                                    <span>Premium Accommodations</span>
                                </div>
                                <div class="feature-item d-flex align-items-center mb-3">
                                    <div class="icon-box me-3">
                                        <i class="fas fa-check-circle text-primary"></i>
                                    </div>
                                    <span>World-Class Dining</span>
                                </div>
                                <div class="feature-item d-flex align-items-center">
                                    <div class="icon-box me-3">
                                        <i class="fas fa-check-circle text-primary"></i>
                                    </div>
                                    <span>Exceptional Service</span>
                                </div>
                            </div>
                            <div class="cta-buttons d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start">
                                <a href="#" class="btn btn-primary rounded-pill px-4 py-2 me-sm-3 mb-2 mb-sm-0">
                                    Discover More
                                </a>
                                <a href="#" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                    Contact Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section End -->

    <!-- Services Section End -->
    <section id="rooms" class="container py-5">
        <h2 class="text-center mb-5 display-5">Our Rooms</h2>
        <div class="row g-4">
            <?php while ($room = mysqli_fetch_assoc($room_result)): ?>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm border-0 rounded-4">
                        <img src="../assets/images/rooms/<?php echo $room['room_image']; ?>" alt="<?php echo $room['room_type']; ?>" class="card-img-top rounded-top-4" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h3 class="h5"><?php echo $room['room_type']; ?></h3>
                            <p class="text-muted"><?php echo $room['room_features']; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">₹<?php echo $room['room_price']; ?>/night</span>
                                <a href="rooms.php" class="btn btn-dark">Book Now →</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>


    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <span>Guest Reviews</span>
                        <h2>What Our Guests Say</h2>
                    </div>
                </div>
            </div>
        </div>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <?php $index = 0; ?>
                <?php while ($review = mysqli_fetch_assoc($review_result)): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="ts-item text-center">
                            <p><?php echo $review['review_text']; ?></p>
                            <div class="ti-author">
                                <div class="rating">
                                    <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                        <i class="icon_star"></i>
                                    <?php endfor; ?>
                                </div>
                                <h5> - User <?php echo $review['user_id']; ?></h5>
                            </div>
                            <img src="../assets/images/room/avatar/avatar-<?php echo $review['user_id']; ?>.jpg" alt="Testimonial" class="mx-auto d-block" style="border-radius:50%;">
                        </div>
                    </div>
                    <?php $index++; ?>
                <?php endwhile; ?>
            </div>
            <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <?php
    include('user_footer.php');
    ?>

    <script>
        $(document).ready(function() {
            $(".hero-slider").owlCarousel({
                items: 1, // Number of items to display
                loop: true, // Infinite looping
                autoplay: true, // Enable auto sliding
                autoplayTimeout: 3000, // Time between slides (in ms)
                dots: true, // Enable navigation dots
                nav: true, // Enable navigation arrows
                onChanged: function(event) {
                    // Get the active slide
                    const activeSlide = event.item.index;
                    const $activeSlide = $(".hs-item").eq(activeSlide);

                    // Get the title and description from the active slide's data attributes
                    const title = $activeSlide.attr("data-title");
                    const description = $activeSlide.attr("data-description");

                    // Update the hero-text content
                    $("#slider-title").text(title);
                    $("#slider-description").text(description);
                }
            });
        });
        // Set the initial title and description for the first slide
        const $firstSlide = $(".hs-item").eq(0);
        $("#slider-title").text($firstSlide.attr("data-title"));
        $("#slider-description").text($firstSlide.attr("data-description"));

        $(document).ready(function() {
            $(".set-bg").each(function() {
                var bg = $(this).data("setbg");
                $(this).css("background-image", "url(" + bg + ")");
            });
        });
    </script>

</body>

</html>