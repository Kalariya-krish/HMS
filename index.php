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
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1 mt-4">
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
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="assets/images/sliders/slider1.jpg"></div>
            <div class="hs-item set-bg" data-setbg="assets/images/sliders/slider2.jpg"></div>
            <div class="hs-item set-bg" data-setbg="assets/images/sliders/slider3.jpg"></div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2>Welcome to <br />Astoria Hotel</h2>
                        </div>
                        <p class="f-para">Astoria Hotel is your ideal destination for luxury and comfort. With top-notch services and modern amenities, we ensure an unforgettable stay.</p>
                        <p class="s-para">Whether you're here for business or leisure, our dedicated team is committed to providing a seamless and enjoyable experience for you.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="assets/images/about/about-1.jpg" alt="">
                            </div>
                            <div class="col-sm-6">
                                <img src="assets/images/about/about-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Services Section Begin -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Services</span>
                        <h2>Experience the Best</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-036-parking"></i>
                        <h4>Exclusive Travel Plans</h4>
                        <p>Plan your perfect vacation with our expert travel assistance and exclusive packages.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-033-dinner"></i>
                        <h4>Gourmet Dining</h4>
                        <p>Enjoy exquisite cuisines from around the world at our in-house restaurants.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="flaticon-026-bed"></i>
                        <h4>Luxury Accommodation</h4>
                        <p>Stay in our well-furnished rooms designed for comfort and relaxation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->


    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="assets/images/room/room-b1.jpg">
                            <!-- <div class="hr-text">
                                <h3>Double Room</h3>
                                <h2>1000Rs.<span>/Pernight</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td>30 ft</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max persion 5</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td>King Beds</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="primary-btn">More Details</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="assets/images/room/room-b2.jpg">
                            <!-- <div class="hr-text">
                                <h3>Premium King Room</h3>
                                <h2>1000Rs.<span>/Pernight</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td>30 ft</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max persion 5</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td>King Beds</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="primary-btn">More Details</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="assets/images/room/room-b3.jpg">
                            <!-- <div class="hr-text">
                                <h3>Deluxe Room</h3>
                                <h2>1000Rs.<span>/Pernight</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td>30 ft</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max persion 5</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td>King Beds</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="primary-btn">More Details</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="assets/images/room/room-b4.jpg">
                            <!-- <div class="hr-text">
                                <h3>Family Room</h3>
                                <h2>1000Rs.<span>/Pernight</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td>30 ft</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max persion 5</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td>King Beds</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="#" class="primary-btn">More Details</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Room Section End -->

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
                        <img src="assets/images/room/avatar/avatar-2.jpg" alt="Testimonial" style="border-radius:50%;">
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
                        <img src="assets/images/room/avatar/avatar-1.jpg" alt="Testimonial" style="border-radius:50%;">
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
                        <img src="assets/images/room/avatar/avatar-1.jpg" alt="Testimonial" style="border-radius:50%;">
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