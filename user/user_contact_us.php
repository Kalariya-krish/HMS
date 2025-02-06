<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>

     <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
<?php
    include_once('user_header.php');
    ?>
    <div class="bg-white min-h-screen">
    <div class="container mx-auto px-4 py-16">
        <!-- Header -->
        <div class="relative mb-20 overflow-hidden">
            <h1 class="text-8xl font-bold text-gray-200 uppercase">Contact</h1>
            <p class="absolute top-1/2 -translate-y-1/2 left-1 text-3xl text-amber-500">Get in Touch</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Info Cards -->
            <div class="space-y-8">
                <!-- Location Card -->
                <div class="group relative overflow-hidden bg-white/5 p-8 rounded-2xl border border-white/5 cursor-pointer"  >
                    <div class="flex items-center space-x-6">
                        <div class="p-4 rounded-xl bg-white/10 ">
                            <svg class="w-6 h-6 text-amber-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                        </div>
                        <div class="text-black">    
                            <h3 class="text-xl font-semibold mb-1">Location</h3>
                            <p class="text-gray-400">Astoria rajkot, gujarat, india</p>
                        </div>
                    </div>
                    <div class="absolute inset-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <!-- Phone Card -->
                <div class="group relative overflow-hidden bg-white/5 p-8 rounded-2xl border border-white/10 hover:border-amber-500 transition-all duration-500 cursor-pointer"
                     @mouseenter="hoveredCard = 'phone'"
                     @mouseleave="hoveredCard = null">
                    <div class="flex items-center space-x-6">
                        <div class="p-4 rounded-xl bg-white/10 ">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div class="text-black">
                            <h3 class="text-xl font-semibold mb-1">Phone</h3>
                            <p class="text-gray-400">+91 9658741236</p>
                        </div>
                    </div>
                    <div class="absolute inset-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <!-- Email Card -->
                <div class="group relative overflow-hidden bg-white/5 p-8 rounded-2xl border border-white/10 hover:border-amber-500 transition-all duration-500 cursor-pointer"
                     @mouseenter="hoveredCard = 'email'"
                     @mouseleave="hoveredCard = null">
                    <div class="flex items-center space-x-6">
                        <div class="p-4 rounded-xl bg-white/10 ">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="text-black">
                            <h3 class="text-xl font-semibold mb-1">Email</h3>
                            <p class="text-gray-400">astoria@gmail.com</p>
                        </div>
                    </div>
                    <div class="absolute inset-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="relative">
                <div class="bg-white/5 p-4 rounded-2xl border-2 border-black hover:border-amber-500 ">
                    <form class="space-y-6" id="contact-form">
                        <div class="relative">
                            <input type="text" placeholder="Your Name" 
                                class="w-full bg-white/5 border-2 border-gray-300 rounded-xl px-6 py-4 text-black placeholder:text-black-500 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300"
                                @focus="focusedInput = 'name'"
                                @blur="focusedInput = null"
                                name="name">
                            <div class="absolute bottom-0 left-0 h-0.5 bg-amber-500 transition-all duration-300"
                                :class="focusedInput === 'name' ? 'w-full' : 'w-0'"></div>
                        </div>

                        <div class="relative">
                            <input type="email" placeholder="Your Email" 
                                class="w-full bg-white/5 border-2 border-gray-300 rounded-xl px-6 py-4 text-black placeholder:text-black/30 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300"
                                @focus="focusedInput = 'email'"
                                @blur="focusedInput = null"
                                name="email">
                            <div class="absolute bottom-0 left-0 h-0.5 bg-amber-500 transition-all duration-300"
                                :class="focusedInput === 'email' ? 'w-full' : 'w-0'"></div>
                        </div>

                        <div class="relative">
                            <textarea placeholder="Your Message" rows="4" 
                                class="w-full bg-white/5 border-2 border-gray-300 rounded-xl px-6 py-4 text-black placeholder:text-black/30 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300"
                                @focus="focusedInput = 'message'"
                                @blur="focusedInput = null"
                                name="message"></textarea>
                            <div class="absolute bottom-0 left-0 h-0.5 bg-amber-500 transition-all duration-300"
                                :class="focusedInput === 'message' ? 'w-full' : 'w-0'"></div>
                        </div>

                        <button type="submit" 
                            class="group w-full bg-amber-500 text-black py-4 px-8 rounded-xl font-semibold hover:bg-amber-600 transition-all duration-300 flex items-center justify-center space-x-2">
                            <span>Send Message</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="mt-20">
            <div class="relative rounded-2xl overflow-hidden border border-white/10 hover:border-amber-500 transition-all duration-500">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3692.9911006588422!2d70.89784917500707!3d22.240416445063865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959b4a660019ee9%3A0x3d6254f36ed0e794!2sRK%20University%20Main%20Campus!5e0!3m2!1sen!2sin!4v1738688058827!5m2!1sen!2sin"
                    class="w-full h-[400px] grayscale hover:grayscale-0 transition-all duration-500"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent pointer-events-none"></div>
            </div>
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
        $(document).ready(function() {
            $("#contact-form").validate({
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
            $("#contact-form").submit(function(e) {
                if (!$(this).valid()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>