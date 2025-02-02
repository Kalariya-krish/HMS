<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>

    <link rel="stylesheet" href="../assets/css/user_mybooking_style.css">
    <!-- <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Subtle gradient background */
            color: #333;
            /* Darker text for better contrast */
        }

        .table-container {
            background-color: #fff;
            border-radius: 15px;
            /* More rounded corners */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
            /* More prominent shadow */
            padding: 30px;
            /* Increased padding */
            margin-top: 40px;
            overflow-x: auto;
            animation: fadeInUp 1s ease-in-out;
            /* Animation on load */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
            border-radius: 15px 15px 0 0;
            overflow: hidden;
        }

        .table thead th {
            background-color: #4285f4;
            /* Google Blue header */
            color: white;
            text-align: left;
            padding: 20px;
            /* Increased padding */
            border-bottom: 2px solid #357ae8;
            /* Slightly darker blue border */
            font-weight: 600;
            /* Semi-bold header text */
            text-transform: uppercase;
            /* Uppercase header text */
            letter-spacing: 0.5px;
            /* Add some letter spacing */
            white-space: nowrap;
        }

        .table tbody tr {
            transition: background-color 0.3s, transform 0.2s;
            /* Smooth hover and transform */
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
            transform: scale(1.02);
            /* Scale up slightly on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            /* Add a subtle shadow on hover */
        }

        .table tbody td {
            padding: 20px;
            /* Increased padding */
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .table tbody tr:last-of-type td {
            border-bottom: none;
        }

        .btn-primary {
            background-color: #4285f4;
            /* Google Blue */
            border-color: #4285f4;
            transition: all 0.2s;
            /* Smooth transition for hover effect */
        }

        .btn-primary:hover {
            background-color: #357ae8;
            border-color: #357ae8;
            transform: scale(1.05);
            /* Scale up on hover */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow on hover */
        }

        .btn-danger {
            background-color: #ea4335;
            /* Google Red */
            border-color: #ea4335;
            transition: all 0.2s;
            /* Smooth transition for hover effect */
        }

        .btn-danger:hover {
            background-color: #d13123;
            border-color: #d13123;
            transform: scale(1.05);
            /* Scale up on hover */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow on hover */
        }


        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style> -->
</head>

<body>
    <?php
    include_once('user_header.php');
    ?>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>My Bookings</h2>
                        <div class="bt-option">
                            <a href="./home.html">Home</a>
                            <span>My Bookings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <div class="container">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Hotel</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Guests</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#12345</td>
                        <td>Grand Hotel</td>
                        <td>2024-03-10</td>
                        <td>2024-03-15</td>
                        <td>2 Adults, 1 Child</td>
                        <td>New York City</td>
                        <td>
                            <button class="btn btn-primary btn-sm">View</button>
                            <button class="btn btn-danger btn-sm">Cancel</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#67890</td>
                        <td>Beach Resort</td>
                        <td>2024-04-01</td>
                        <td>2024-04-05</td>
                        <td>2 Adults</td>
                        <td>Miami Beach</td>
                        <td>
                            <button class="btn btn-primary btn-sm">View</button>
                            <button class="btn btn-danger btn-sm">Cancel</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br><br>

    <?php
    include_once('user_footer.php');
    ?>
</body>

</html>