<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/css/admin_style.css">
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body,
        a {
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body>
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <div class="me-3">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
            </div>
            <div>
                <a class="navbar-brand brand-logo" href="index.html">
                    <img src="../assets/images/logo.png" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html">
                    <img src="../assets/images/logo.png" alt="logo" />
                </a>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav ms-auto">
                <!-- <li class="nav-item">
                    <form class="search-form" action="#">
                        <i class="icon-search"></i>
                        <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                    </form>
                </li> -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                        <i class="icon-bell"></i>
                        <span class="count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                        <a class="dropdown-item py-3 border-bottom">
                            <p class="mb-0 fw-medium float-start">You have 4 new notifications </p>
                            <span class="badge badge-pill badge-primary float-end">View all</span>
                        </a>
                        <a class="dropdown-item preview-item py-3">
                            <div class="preview-thumbnail">
                                <i class="mdi mdi-alert m-auto text-primary"></i>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
                                <p class="fw-light small-text mb-0"> Just now </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item py-3">
                            <div class="preview-thumbnail">
                                <i class="mdi mdi-lock-outline m-auto text-primary"></i>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
                                <p class="fw-light small-text mb-0"> Private message </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item py-3">
                            <div class="preview-thumbnail">
                                <i class="mdi mdi-airballoon m-auto text-primary"></i>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
                                <p class="fw-light small-text mb-0"> 2 days ago </p>
                            </div>
                        </a>
                    </div>
                </li> -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="icon-mail icon-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
                        <a class="dropdown-item py-3">
                            <p class="mb-0 fw-medium float-start">You have 7 unread mails </p>
                            <span class="badge badge-pill badge-primary float-end">View all</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="../assets/images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis fw-medium text-dark">Marian Garner </p>
                                <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="../assets/images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis fw-medium text-dark">David Grey </p>
                                <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="../assets/images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis fw-medium text-dark">Travis Jenkins </p>
                                <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                            </div>
                        </a>
                    </div>
                </li> -->
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-xs rounded-circle" src="../assets/images/adminimage.png" alt="Profile image" height="50px" width="50px"> </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-md rounded-circle" src="../assets/images/adminimage.png" alt="Profile image" height="50px" width="50px">
                            <p class=" mb-1 mt-3 fw-semibold">Kris Kalariya</p>
                            <p class="fw-light text-muted mb-0">kkalariya174@rku.ac.in</p>
                        </div>
                        <!-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a> -->
                        <!-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                        <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                        <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a> -->
                        <a class="dropdown-item" href="admin_logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="admin_dashboard.php">
                    <i class="mdi mdi-grid-large menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Management</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#room-management" aria-expanded="false" aria-controls="room-management">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">Rooms</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="room-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="admin_add_room.php">Add Room</a></li>
                        <li class="nav-item"> <a class="nav-link" href="admin_manage_rooms.php">Manage Rooms</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#booking-management" aria-expanded="false" aria-controls="booking-management">
                    <i class="menu-icon mdi mdi-card-text-outline"></i>
                    <span class="menu-title">Bookings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="booking-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="admin_manage_bookings.php">View All Bookings</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_pending_bookings.php">Pending Bookings</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_checkin_checkout.php">Check-In/Check-Out</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#payment-management" aria-expanded="false" aria-controls="payment-management">
                    <i class="menu-icon mdi mdi-credit-card"></i>
                    <span class="menu-title">Payments</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="payment-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="admin_manage_payments.php">View Payments</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_refund_payments.php">Refund Payments</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#discount-offer" aria-expanded="false" aria-controls="discount-offer">
                    <i class="menu-icon mdi mdi-sale"></i>
                    <span class="menu-title">Discounts & Offers</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="discount-offer">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="admin_add_offer.php">Add New Offer</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_manage_offers.php">Manage Offers</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin_expired_offers.php">Expired Offers</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#review-management" aria-expanded="false" aria-controls="review-management">
                    <i class="menu-icon mdi mdi-comment-text-outline"></i>
                    <span class="menu-title">Reviews</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="review-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="admin_manage_reviews.php">View Reviews</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#bill-management" aria-expanded="false" aria-controls="bill-management">
                    <i class="menu-icon mdi mdi-file-document-outline"></i>
                    <span class="menu-title">Bills</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="bill-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="admin_manage_bills.php">View All Bills</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#contact-management" aria-expanded="false" aria-controls="contact-management">
                    <i class="menu-icon mdi mdi-email-outline"></i>
                    <span class="menu-title">Contacts</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="contact-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="admin_manage_contacts.php">View All Contacts</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#user-management" aria-expanded="false" aria-controls="user-management">
                    <i class="menu-icon mdi mdi-account-circle-outline"></i>
                    <span class="menu-title">Users</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="user-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="admin_manage_users.php">View Users</a></li>
                        <li class="nav-item"> <a class="nav-link" href="admin_add_user.php">Add User</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#admin-management" aria-expanded="false" aria-controls="admin-management">
                    <i class="menu-icon mdi mdi-table"></i>
                    <span class="menu-title">Admins</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="admin-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="admin_manage_admins.php">Manage Admins</a></li>
                        <li class="nav-item"> <a class="nav-link" href="admin_add_admin.php">Add Admin</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#more-management" aria-expanded="false" aria-controls="admin-management">
                    <i class="menu-icon mdi mdi-table"></i>
                    <span class="menu-title">More</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="more-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="admin_manage_sliders.php">Manage Sliders</a></li>
                        <!-- <li class="nav-item"> <a class="nav-link" href="admin_manage_about.php">Manage About Page</a></li> -->
                    </ul>
                </div>
            </li>
        </ul>
    </nav>



    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/template.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <!-- <script src="../assets/js/todolist.js"></script> -->
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script> -->
    <script src="../assets/js/dashboard.js"></script>
    <!-- <script src="../assets/js/Chart.roundedBarCharts.js"></script> -->

    <!-- JS -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/additional-methods.min.js"></script>
    <!-- End custom js for this page-->



</body>

</html>