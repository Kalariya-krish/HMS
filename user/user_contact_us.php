<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
</head>

<body>
    <?php
    include_once('user_header.php');
    ?>

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-text">
                        <h2>Contact Info</h2>
                        <p>Have questions or need assistance with your booking? Our team is here to help! Contact us for reservations, special offers, or any inquiries regarding your stay at our hotel.</p>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="c-o">Address:</td>
                                    <td>Astoria rajkot,gujarat,india</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Phone:</td>
                                    <td>+91 9658741236</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Email:</td>
                                    <td>astoria@gmail.com</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Fax:</td>
                                    <td>+(12) 345 67890</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <form action="#" class="contact-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="name" placeholder="Your Name">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="email" placeholder="Your Email">
                            </div>
                            <div class="col-lg-12">
                                <textarea name="message" placeholder="Your Message"></textarea>
                                <button type="submit">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3692.9911006588422!2d70.89784917500707!3d22.240416445063865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959b4a660019ee9%3A0x3d6254f36ed0e794!2sRK%20University%20Main%20Campus!5e0!3m2!1sen!2sin!4v1738688058827!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <?php
    include('user_footer.php');
    ?>

    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".contact-form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Name must be at least 3 characters"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Enter a valid email address"
                    },
                    message: {
                        required: "Please enter your message",
                        minlength: "Message must be at least 10 characters"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });

            // Prevent form submission if validation fails
            $(".contact-form").submit(function(e) {
                if (!$(this).valid()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>