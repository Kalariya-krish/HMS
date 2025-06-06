<?php
include_once('../db_connection.php');
include_once('../auth_check.php');
include_once('../mailer.php'); // Include the mailer file

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $status = 'pending'; // Default status

    if ($subject === "Other") {
        $subject = mysqli_real_escape_string($con, $_POST['other_subject']);
    }

    // Store inquiry in database with resolution status
    $q = "INSERT INTO contact_inquiries (name, email, subject, message, status, sent_at) 
        VALUES ('$name', '$email', '$subject', '$message', '$status', NOW())";

    if (mysqli_query($con, $q)) {
        // Prepare email content
        $email_subject = "Thank you for contacting us - " . $subject;
        $email_body = "
        <html>
        <head>
            <title>Contact Inquiry Confirmation</title>
        </head>
        <body>
            <h2>Hello $name,</h2>
            <p>Thank you for contacting us regarding: <strong>$subject</strong></p>
            <p>We have received your message:</p>
            <blockquote>$message</blockquote>
            <p>Our team will get back to you soon. Your inquiry status is currently: <strong>Pending</strong></p>
            <p>Best regards,<br>Astoria Hotel Team</p>
        </body>
        </html>
        ";

        // Send email using PHPMailer
        $email_result = sendEmail($email, $email_subject, $email_body, null);

        if ($email_result === true) {
            echo "<script>alert('Your message has been sent successfully!'); window.location.href='user_contact_us.php';</script>";
        } else {
            // Email failed but inquiry was saved
            error_log("Email sending failed: " . $email_result);
            echo "<script>alert('Your inquiry was received but we couldn't send confirmation email. Please check your email address.'); window.location.href='user_contact_us.php';</script>";
        }
    } else {
        echo "<script>alert('Something went wrong. Please try again later.'); window.history.back();</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
</head>

<body>
    <?php
    include_once('user_header.php');
    ?>
    <div class="container py-5">
        <!-- Contact Header -->
        <div class="page-title text-center">
            <h1>Contact</h1>
            <p class="overlay-text">Get in Touch</p>
        </div>

        <div class="row g-4">
            <!-- Contact Information -->
            <div class="col-lg-5">
                <div class="space-y-4">
                    <!-- Location Card -->
                    <div class="contact-card p-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="mb-1">Location</h5>
                                <p class="text-muted mb-0">Astoria rajkot, gujarat, india</p>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Card -->
                    <div class="contact-card p-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="mb-1">Phone</h5>
                                <p class="text-muted mb-0">+91 9658741236</p>
                            </div>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="contact-card p-4">
                        <div class="d-flex align-items-center">
                            <div class="contact-icon me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="mb-1">Email</h5>
                                <p class="text-muted mb-0">astoria@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="contact-card p-5">
                    <form id="contactForm" method="POST">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Your Name" name="name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" placeholder="Your Email" name="email">
                        </div>
                        <div class="mb-3">
                            <select class="form-control" name="subject" id="subject" onchange="toggleOtherInput()">
                                <option value="" disabled selected>Select a subject</option>
                                <option value="Room Availability">Room Availability & Booking</option>
                                <option value="Modify Booking">Modify or Cancel Booking</option>
                                <option value="Payment Issues">Payment & Billing Issues</option>
                                <option value="Discounts Offers">Discounts & Offers Inquiry</option>
                                <option value="Checkin Checkout">Early Check-in / Late Check-out Request</option>
                                <option value="Hotel Services">Hotel Services & Facilities Inquiry</option>
                                <option value="Feedback">Feedback & Suggestions</option>
                                <option value="Complaint">Complaint & Service Issues</option>
                                <option value="Technical Issues">Technical Issues (Website / App)</option>
                                <option value="Other">Other</option>
                            </select>

                            <!-- Floating Label Input Field for Other -->
                            <div id="otherSubjectDiv" class="input-container" style="display: none;">
                                <input type="text" name="other_subject" id="other_subject" required>
                                <label for="other_subject">Specify your subject</label>
                                <div class="underline"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="message" rows="4" placeholder="Your Message" name="message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit btn-dark" name="submit">
                            Send Message
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="mt-5">
            <div class="contact-card overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3692.9911006588422!2d70.89784917500707!3d22.240416445063865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959b4a660019ee9%3A0x3d6254f36ed0e794!2sRK%20University%20Main%20Campus!5e0!3m2!1sen!2sin!4v1738688058827!5m2!1sen!2sin"
                    class="w-100"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
    <?php
    include_once('user_footer.php');
    ?>



    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/additional-methods.min.js"></script>

    <script>
        function toggleOtherInput() {
            var subjectDropdown = document.getElementById("subject");
            var otherInputDiv = document.getElementById("otherSubjectDiv");
            var otherInput = document.getElementById("other_subject");

            if (subjectDropdown.value === "Other") {
                otherInputDiv.style.display = "block";
                otherInput.focus();
            } else {
                otherInputDiv.style.display = "none";
                otherInput.value = "";
            }
        }

        $(document).ready(function() {
            $("#contactForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    subject: {
                        required: true
                    },
                    message: {
                        required: true,
                        minlength: 10
                    },
                    other_subject: {
                        required: function(element) {
                            return $("#subject").val() === "Other";
                        }
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
                    subject: {
                        required: "Please select a subject"
                    },
                    message: {
                        required: "Please enter your message",
                        minlength: "Message must be at least 10 characters"
                    },
                    other_subject: {
                        required: "Please specify your subject"
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

            $("#contactForm").submit(function(e) {
                if (!$(this).valid()) {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>

</html>