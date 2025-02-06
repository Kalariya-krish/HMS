<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Room Detail</title>
</head>

<body>
    <?php
    include_once('header.php');
    ?>

    <div class="container py-5">
        <!-- Breadcrumb Section Begin -->
        <div class="page-title text-center">
            <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deluxe Room</h1>
            <p class="overlay-text">Room Details</p>
        </div>
        <!-- Breadcrumb Section End -->

        <!-- Room Details Section Begin -->
        <section class="room-details-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="room-details-item">
                            <img src="assets/images/room/room-details.jpg" alt="">
                            <div class="rd-text">
                                <div class="rd-title">
                                    <h3>Premium King Room</h3>
                                    <div class="rdt-right">
                                        <div class="rating">
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star-half_alt"></i>
                                        </div>
                                        <a href="#">Booking Now</a>
                                    </div>
                                </div>
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
                                <p class="f-para">
                                    Experience luxury and comfort in our Premium King Room, designed for ultimate relaxation.
                                    This spacious room offers modern amenities, plush bedding, and elegant decor, ensuring
                                    a memorable stay. Whether you're traveling for business or leisure, our room provides the
                                    perfect retreat with scenic views and top-notch hospitality.
                                </p>
                                <p>
                                    Guests can enjoy 24/7 room service, high-speed Wi-Fi, and access to our exclusive
                                    hotel facilities, including a rooftop restaurant and spa. Book now to indulge in
                                    an exceptional stay with world-class service.
                                </p>
                            </div>
                        </div>
                        <div class="rd-reviews">
                            <h4>Reviews</h4>
                            <div class="review-item">
                                <div class="ri-pic">
                                    <img src="assets/images/room/avatar/avatar-1.jpg" alt="">
                                </div>
                                <div class="ri-text">
                                    <span>15 Jan 2024</span>
                                    <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <h5>Ava Richardson</h5>
                                    <p>
                                        Absolutely loved my stay here! The room was spotless, beautifully designed, and the bed was so comfortable.
                                        The staff was extremely friendly, and the service was impeccable. Highly recommend this hotel for a perfect getaway!
                                    </p>
                                </div>
                            </div>
                            <div class="review-item">
                                <div class="ri-pic">
                                    <img src="assets/images/room/avatar/avatar-2.jpg" alt="">
                                </div>
                                <div class="ri-text">
                                    <span>20 Dec 2023</span>
                                    <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star-half_alt"></i>
                                    </div>
                                    <h5>James Anderson</h5>
                                    <p>
                                        Great experience! The check-in process was smooth, and the staff was very accommodating.
                                        The room had a fantastic city view, and I loved the complimentary breakfast. Will definitely book again!
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="container mt-4">
                            <div class="review-add card p-4 shadow-sm">
                                <h4 class="mb-3">Add Review</h4>
                                <form id="reviewForm" class="needs-validation">
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="name" class="form-label">Name*</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="email" class="form-label">Email*</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label for="rating" class="form-label">Your Rating*</label>
                                            <select id="rating" name="rating" class="form-select">
                                                <option value="">Select Rating</option>
                                                <option value="1">1 Star</option>
                                                <option value="2">2 Stars</option>
                                                <option value="3">3 Stars</option>
                                                <option value="4">4 Stars</option>
                                                <option value="5">5 Stars</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label for="review" class="form-label">Your Review*</label>
                                            <textarea id="review" name="review" class="form-control" rows="4" placeholder="Write your review here"></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-dark w-100">Submit Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="booking-form p-4 border rounded shadow">
                            <h3 class="mb-4">Your Reservation</h3>
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
        </section>
        <!-- Room Details Section End -->
    </div>
    <?php
    include('footer.php');
    ?>


    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {

            // Custom regex method for name validation
            $.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
            }, "Only letters and spaces are allowed");

            $("#reviewForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 30,
                        lettersOnly: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    review: {
                        required: true,
                        minlength: 10,
                        maxlength: 500
                    },
                    rating: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Name is required",
                        minlength: "Name must be at least 3 characters",
                        maxlength: "Name cannot exceed 30 characters"
                    },
                    email: {
                        required: "Email is required",
                        email: "Enter a valid email"
                    },
                    review: {
                        required: "Review is required",
                        minlength: "Review must be at least 10 characters",
                        maxlength: "Review cannot exceed 500 characters"
                    },
                    rating: {
                        required: "Please select a rating"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    if (element.prop("tagName") === "SELECT") {
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });

            $("#reviewForm").submit(function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    alert('Review submitted successfully!');
                    this.submit();
                }
            });
        });
    </script>


</body>

</html>