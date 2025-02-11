<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Astoria</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php
    include_once('header.php');
    ?>

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Astoria A Luxury Hotel</h1>
                        <p>Here are the best hotel booking sites, including recommendations for international travel and for finding low-priced hotel rooms.</p>
                        <!-- <a href="#" class="primary-btn">Discover Now</a> -->
                    </div>
                </div>
                <!-- <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1 mt-4">
                    <div class="booking-form p-4 border rounded shadow">
                        <h3 class="mb-4">Booking Your Hotel</h3>
                        <form action="#">
                            <div class="mb-3">
                                <label for="date-in" class="form-label">Check In:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control" id="date-in">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="date-out" class="form-label">Check Out:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control" id="date-out">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="guest" class="form-label">Guests:</label>
                                <select id="guest" class="form-select">
                                    <option value="2">2 Adults</option>
                                    <option value="3">3 Adults</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="room" class="form-label">Rooms:</label>
                                <select id="room" class="form-select">
                                    <option value="1">1 Room</option>
                                    <option value="2">2 Rooms</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Check Availability</button>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="assets/images/sliders/slider1.jpg"></div>
            <div class="hs-item set-bg" data-setbg="assets/images/sliders/slider2.jpg"></div>
            <div class="hs-item set-bg" data-setbg="assets/images/sliders/slider3.jpg"></div>
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
                                <img src="assets/images/about/about1.jpg"
                                    class="img-fluid rounded-4 w-100 h-auto main-image shadow-lg transition-transform duration-300 hover:scale-95"
                                    alt="Astoria Hotel Exterior">
                            </div>
                            <div class="col-md-4 col-12">
                                <img src="assets/images/about/about2.jpg"
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
    <section id="rooms" class="container mx-auto py-8 sm:py-12 md:py-16 lg:py-20 px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl sm:text-3xl md:text-4xl text-center font-serif mb-6 sm:mb-8 md:mb-10 lg:mb-12">Our Rooms</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 lg:gap-10">
            <!-- Room Card 1 -->
            <div class="bg-white rounded-2xl overflow-hidden hover:shadow-lg transition-shadow duration-300 shadow">
                <img src="assets/images/room/room4.jpg" alt="Double Room" class="w-full h-48 sm:h-56 md:h-64 lg:h-80 object-cover">
                <div class="p-4 sm:p-5 lg:p-6">
                    <h3 class="text-xl sm:text-2xl font-serif mb-2 sm:mb-3 lg:mb-4">Double Room</h3>
                    <p class="text-gray-600 text-sm sm:text-base mb-3 sm:mb-4">Spacious room with modern amenities and king beds.</p>
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <span class="text-lg sm:text-xl font-bold">₹1,000/night</span>
                        <a href="rooms.php" class="w-full sm:w-auto text-center text-black font-medium hover:bg-blue-600 hover:text-white transition-colors duration-300 px-2 py-2 rounded-xl bg-gray-300">
                            Book Now →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Room Card 2 -->
            <div class="bg-white rounded-2xl overflow-hidden hover:shadow-lg transition-shadow duration-300 shadow">
                <img src="assets/images/room/room1.jpg" alt="Premium Room" class="w-full h-48 sm:h-56 md:h-64 lg:h-80 object-cover">
                <div class="p-4 sm:p-5 lg:p-6">
                    <h3 class="text-xl sm:text-2xl font-serif mb-2 sm:mb-3 lg:mb-4">Premium Room</h3>
                    <p class="text-gray-600 text-sm sm:text-base mb-3 sm:mb-4">Luxurious suite with panoramic city views and premium services.</p>
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <span class="text-lg sm:text-xl font-bold">₹2,000/night</span>
                        <a href="rooms.php" class="w-full sm:w-auto text-center text-black font-medium hover:bg-blue-600 hover:text-white transition-colors duration-300 px-2 py-2 rounded-xl bg-gray-300">
                            Book Now →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Room Card 3 -->
            <div class="bg-white rounded-2xl overflow-hidden hover:shadow-lg transition-shadow duration-300 shadow">
                <img src="assets/images/room/room2.jpg" alt="Family Room" class="w-full h-48 sm:h-56 md:h-64 lg:h-80 object-cover">
                <div class="p-4 sm:p-5 lg:p-6">
                    <h3 class="text-xl sm:text-2xl font-serif mb-2 sm:mb-3 lg:mb-4">Family Room</h3>
                    <p class="text-gray-600 text-sm sm:text-base mb-3 sm:mb-4">Spacious accommodation perfect for families with children.</p>
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <span class="text-lg sm:text-xl font-bold">₹1,500/night</span>
                        <a href="rooms.php" class="w-full sm:w-auto text-center text-black font-medium hover:bg-blue-600 hover:text-white transition-colors duration-300 px-2 py-2 rounded-xl bg-gray-300">
                            Book Now →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Room Card 4 -->
            <div class="bg-white rounded-2xl overflow-hidden hover:shadow-lg transition-shadow duration-300 shadow">
                <img src="assets/images/room/room3.jpg" alt="Presidential Suite" class="w-full h-48 sm:h-56 md:h-64 lg:h-80 object-cover">
                <div class="p-4 sm:p-5 lg:p-6">
                    <h3 class="text-xl sm:text-2xl font-serif mb-2 sm:mb-3 lg:mb-4">Presidential Suite</h3>
                    <p class="text-gray-600 text-sm sm:text-base mb-3 sm:mb-4">Ultimate luxury experience with extensive amenities and services.</p>
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <span class="text-lg sm:text-xl font-bold">₹5,000/night</span>
                        <a href="rooms.php" class="w-full sm:w-auto text-center text-black font-medium hover:bg-blue-600 hover:text-white transition-colors duration-300 px-2 py-2 rounded-xl bg-gray-300">
                            Book Now →
                        </a>
                    </div>
                </div>
            </div>
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
                <div class="carousel-item active">
                    <div class="ts-item text-center">
                        <p>Booking a stay at this hotel was the best decision! The room was spotless, the staff was
                            incredibly friendly, and the entire process was seamless. Highly recommend for anyone looking
                            for a stress-free vacation!</p>
                        <div class="ti-author">
                            <div class="rating">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                            </div>
                            <h5> - Emily Johnson</h5>
                        </div>
                        <img src="assets/images/room/avatar/avatar-2.jpg" alt="Testimonial" class="mx-auto d-block" style="border-radius:50%;">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="ts-item text-center">
                        <p>Fantastic experience from start to finish! Booking online was simple, and the hotel exceeded my
                            expectations. The ocean-view room was breathtaking, and the service was top-notch. Will definitely
                            book again.</p>
                        <div class="ti-author">
                            <div class="rating">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star-half_alt"></i>
                            </div>
                            <h5> - Michael Roberts</h5>
                        </div>
                        <img src="assets/images/room/avatar/avatar-1.jpg" alt="Testimonial" class="mx-auto d-block" style="border-radius:50%;">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="ts-item text-center">
                        <p>I travel frequently, and this hotel truly stands out! The seamless online booking, warm
                            welcome upon arrival, and luxurious room made my trip unforgettable. I can't wait to return!</p>
                        <div class="ti-author">
                            <div class="rating">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                            </div>
                            <h5> - Sarah Thompson</h5>
                        </div>
                        <img src="assets/images/room/avatar/avatar-1.jpg" alt="Testimonial" class="mx-auto d-block" style="border-radius:50%;">
                    </div>
                </div>
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
    include('footer.php');
    ?>

    <script>
        $(document).ready(function() {
            $(".hero-slider").owlCarousel({
                items: 1, // Number of items to display
                loop: true, // Infinite looping
                autoplay: true, // Enable auto sliding
                autoplayTimeout: 3000, // Time between slides (in ms)
                dots: true, // Enable navigation dots
                nav: true // Enable navigation arrows
            });
        });
        $(document).ready(function() {
            $(".set-bg").each(function() {
                var bg = $(this).data("setbg");
                $(this).css("background-image", "url(" + bg + ")");
            });
        });
    </script>

</body>

</html>