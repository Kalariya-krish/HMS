<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Management System</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Add FontAwesome and Bootstrap if not already included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css" type="text/css">

    <style>
        a {
            text-decoration: none !important;
        }

        .nav-profile {
            position: relative;
            display: inline-block;
            padding: 10px;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            /* Positions dropdown exactly below */
            left: 50%;
            transform: translateX(-50%);
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 10;
            text-align: center;
            padding: 10px 0;
        }

        .dropdown-content a {
            color: black;
            padding: 10px;
            text-decoration: none;
            display: block;
            transition: background 0.3s ease-in-out;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .nav-profile:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">
        <i class="icon_menu"></i>
    </div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="icon_close"></i>
        </div>
        <nav class="mainmenu mobile-menu">
            <ul>
                <li class="active"><a href="user_index.php">Home</a></li>
                <li><a href="user_about_us.php">About Us</a>
                <li><a href="user_rooms.php">Room</a>
                    <ul class="dropdown">
                        <li><a href="user_rooms.php?room_type=Deluxe">Deluxe Room</a></li>
                        <li><a href="user_rooms.php?room_type=Luxury">Luxury Room</a></li>
                        <li><a href="user_rooms.php?room_type=Family">Family Room</a></li>
                        <li><a href="user_rooms.php?room_type=Premium">Premium Room</a></li>
                    </ul>
                </li>
                <li><a href="user_contact_us.php">Contact Us</a></li>
                <div class="nav-profile">
                    <img src="../assets/images/profile_picture/<?php echo $_SESSION['profile_picture']; ?>" alt="Profile" class="profile-pic">
                    <div class="dropdown-content">
                        <a href="user_mybookings.php">My Bookings</a>
                        <a href="user_edit_profile.php">Edit Profile</a>
                        <a href="user_change_password.php">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="text-danger">Logout</a>
                    </div>
                </div>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="./index.html">
                                <img src="../assets/images/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li class="active"><a href="user_index.php">Home</a></li>
                                    <li><a href="user_about_us.php">About Us</a></li>
                                    <li><a href="user_rooms.php">Rooms</a>
                                        <ul class="dropdown">
                                            <li><a href="user_rooms.php?room_type=Deluxe">Deluxe Room</a></li>
                                            <li><a href="user_rooms.php?room_type=Luxury">Luxury Room</a></li>
                                            <li><a href="user_rooms.php?room_type=Family">Family Room</a></li>
                                            <li><a href="user_rooms.php?room_type=Premium">Premium Room</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="user_contact_us.php">Contact Us</a></li>
                                    <div class="nav-profile" id="profileDropdown">
                                        <img src="../assets/images/profile_picture/<?php echo $_SESSION['profile_picture']; ?>" alt="Profile" class="profile-pic">
                                        <div class="dropdown-content">
                                            <a href="user_mybookings.php">My Bookings</a>
                                            <a href="user_myinquiry.php">My Inquries</a>
                                            <a href="user_edit_profile.php">Edit Profile</a>
                                            <a href="user_change_password.php">Change Password</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="user_logout.php" class="text-danger">Logout</a>
                                        </div>
                                    </div>


                                    <!-- <a href="user_mybookings.php"><button class="btn btn-primary">My Bookings</button></a> -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->



    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery-ui.min.js"></script>
    <script src="../assets/js/jquery.slicknav.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const profileDropdown = document.getElementById("profileDropdown");
            const dropdownContent = profileDropdown.querySelector(".dropdown-content");

            profileDropdown.addEventListener("click", function(event) {
                event.stopPropagation(); // Prevent event from bubbling up
                dropdownContent.classList.toggle("show-dropdown");
            });

            // Close the dropdown when clicking outside
            document.addEventListener("click", function(event) {
                if (!profileDropdown.contains(event.target)) {
                    dropdownContent.classList.remove("show-dropdown");
                }
            });
        });
    </script>

    <style>
        .dropdown-content {
            display: none;
        }

        .show-dropdown {
            display: block;
        }
    </style>

</body>

</html>