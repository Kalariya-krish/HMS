-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2025 at 04:37 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `services` text,
  `gallery_images` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `description`, `services`, `gallery_images`) VALUES
(1, 'Welcome To Astoria.', 'Astoria Hotel offers a seamless and luxurious booking experience. Whether you’re traveling for business or leisure, our world-class hospitality ensures your stay is unforgettable.\nWith modern amenities, comfortable accommodations, and exclusive offers, we make sure every moment of your stay is exceptional. Book with us today and experience elegance at its finest.', '[ \"Easy & Secure Online Booking\", \"Best Price Guarantee\", \"Complimentary Breakfast\", \"High-Speed Free WiFi\", \"24/7 Customer Support\" ]', '[ \"assets/images/gallery/gallery-1.jpg\", \"assets/images/gallery/gallery-2.jpg\", \"assets/images/gallery/gallery-3.jpg\", \"assets/images/gallery/gallery-4.jpg\" ]');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int NOT NULL,
  `booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `generated_at` date NOT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `payment_status` enum('Paid','Pending','Unpaid') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `booking_id`, `user_id`, `amount`, `generated_at`, `pdf_path`, `payment_status`) VALUES
(1, 208, 30, 20000.00, '2025-04-03', 'njcnnf/edjnejn/f', 'Paid'),
(2, 209, 30, 30000.00, '2025-04-04', 'bill_2.pdf', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `guest_name` varchar(50) NOT NULL,
  `room_no` int NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `guests` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('Pending','Confirmed','Cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `checkin_status` enum('Not Checked-In','Checked-In','Checked-Out') DEFAULT 'Not Checked-In'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `guest_name`, `room_no`, `check_in`, `check_out`, `guests`, `total_price`, `status`, `created_at`, `checkin_status`) VALUES
(208, 30, 'Krish KK', 101, '2025-04-18', '2025-04-25', 1, 30000.00, 'Confirmed', '2025-04-07 16:10:21', 'Not Checked-In'),
(209, 30, 'Krish KK', 2003, '2025-04-10', '2025-04-11', 3, 5353535.00, 'Pending', '2025-04-07 16:10:40', 'Not Checked-In');

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiries`
--

CREATE TABLE `contact_inquiries` (
  `message_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_inquiries`
--

INSERT INTO `contact_inquiries` (`message_id`, `name`, `email`, `subject`, `message`, `sent_at`) VALUES
(4, 'Michael Johnson', 'michael@example.com', 'Feedback', 'The service was great, but I would suggest improving the breakfast options.', '2025-02-17 10:42:45'),
(5, 'Jane Smith', 'jane@example.com', 'Payment Issue', 'My payment is not reflecting, kindly assist.', '2025-02-16 03:50:10'),
(6, 'Bob Johnson', 'bob@example.com', 'Payment Issue', 'I made a payment but did not receive confirmation.', '2025-02-12 16:22:00'),
(7, 'KKK', 'kkalariya174@rku.ac.in', 'room size not satisfied', 'hdjhdhdbhbh dhbcvcubvhbhvbvdsv', '2025-02-27 15:00:18'),
(8, 'dvfggf', 'kalariyakrish12@gmail.com', 'Discounts Offers', 'veferfrefefefrf', '2025-02-27 15:01:03'),
(9, 'dffrfrfrfre', 'feffefef@gmail.com', 'Room Availability', 'fdvvrvrrdfcdd', '2025-02-27 15:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offer_id` int NOT NULL,
  `offer_title` varchar(100) NOT NULL,
  `discount_percentage` int NOT NULL,
  `valid_from` date NOT NULL,
  `valid_until` date NOT NULL,
  `offer_description` text NOT NULL,
  `offer_image` varchar(255) NOT NULL,
  `status` enum('Active','Expired') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offer_id`, `offer_title`, `discount_percentage`, `valid_from`, `valid_until`, `offer_description`, `offer_image`, `status`) VALUES
(6, 'Summer Holiday', 40, '2025-12-01', '2025-12-25', 'Enjoy 40% off on gifts and accessories this Christmas.', '67b429e211da1pexels-polina-kovaleva-6185466.jpg', 'Active'),
(7, 'Summer Holiday Week 3', 60, '2025-04-05', '2025-04-10', 'Tis is very peacefull moment', '67ecf80a1939ewp3435099-lord-krishna-3d-images-in-black-background.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_requests`
--

CREATE TABLE `password_reset_requests` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `expires_at` timestamp NOT NULL,
  `otp_attempts` int NOT NULL,
  `last_resend` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `password_reset_requests`
--

INSERT INTO `password_reset_requests` (`id`, `email`, `otp`, `created_at`, `expires_at`, `otp_attempts`, `last_resend`) VALUES
(25, 'kkalariya174@rku.ac.in', '485205', '2025-03-29 01:56:49', '2025-03-29 01:58:49', 3, '2025-03-29 07:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int NOT NULL,
  `booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('Credit_card','Debit_card','Paypal','Cash') NOT NULL,
  `payment_status` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `transaction_id` varchar(100) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `user_id`, `amount`, `payment_method`, `payment_status`, `transaction_id`, `payment_date`) VALUES
(1, 208, 30, 30000.00, 'Credit_card', 'Pending', '222', '2025-04-07 16:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `refund_id` int NOT NULL,
  `booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `guest_name` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `refund_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `refunds`
--

INSERT INTO `refunds` (`refund_id`, `booking_id`, `user_id`, `guest_name`, `amount`, `refund_date`, `status`) VALUES
(1, 209, 30, 'krish kalariya', 2000.00, '2025-04-07 16:30:40', 'Approved'),
(2, 208, 30, 'krish kalariya', 30000.00, '2025-04-07 16:31:12', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int NOT NULL,
  `user_id` int NOT NULL,
  `room_no` int NOT NULL,
  `rating` int DEFAULT NULL,
  `review_text` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Approved','Spam') DEFAULT 'Pending'
) ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `room_no`, `rating`, `review_text`, `created_at`, `status`) VALUES
(1, 30, 2003, 5, 'very good room', '2025-04-07 16:32:26', 'Approved'),
(2, 30, 311, 2, 'very bed room', '2025-04-07 16:33:57', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `room_no` int NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` varchar(30) NOT NULL,
  `capacity` varchar(30) NOT NULL,
  `bed` varchar(255) NOT NULL,
  `room_status` enum('Available','Booked','Maintenance') NOT NULL,
  `services` text NOT NULL,
  `description` text,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_no`, `room_name`, `room_type`, `price`, `size`, `capacity`, `bed`, `room_status`, `services`, `description`, `image`) VALUES
(7, 311, 'ROOM311', 'deluxe', 10000.00, '40.ft', '3 Persons', '3', 'Available', 'ac, wifi, tv', 'hdhcbhdbb cbhdbcbec ccbdhcbehcbehbfe febfhebf', '67e7f783e892b_pexels-ian-panelo-8333070.jpg'),
(9, 2003, 'vffgvrgrg dfe', 'double', 5353535.00, '30 ft', '3 Persons', '3', 'Available', 'ac, wifi, tv', 'vfv fe gg ffrr', '67ee812137392_wp3435099-lord-krishna-3d-images-in-black-background.jpg'),
(10, 101, 'Luxuries family room', 'deluxe', 30000.00, '30', '4', '4', 'Available', 'ac, wifi, tv, minibar', 'dffghg hgfgdhdg', '67f0eacc3fb97_room3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int NOT NULL,
  `slider_title` varchar(100) DEFAULT NULL,
  `slider_description` text,
  `slider_image` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_title`, `slider_description`, `slider_image`, `status`, `created_at`) VALUES
(1, 'Welcome to Luxury Stay', 'Experience the best hospitality with our premium rooms.', 'slider1.jpg', 'Active', '2025-02-12 16:21:50'),
(2, 'Special Discount Offer', 'Get up to 20% off on advance bookings.', 'slider2.jpg', 'Active', '2025-02-12 16:21:50'),
(3, 'Hello', '	Experience the best hospitality with our premium r...', '67b96d1a806f8_pexels-polina-kovaleva-6185466.jpg', 'Active', '2025-02-19 14:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `confirm_password` varchar(20) NOT NULL,
  `mobile_no` bigint DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `role` enum('guest','admin') DEFAULT 'guest',
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'inactive',
  `profile_picture` varchar(200) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `confirm_password`, `mobile_no`, `address`, `role`, `status`, `profile_picture`, `activation_code`) VALUES
(10, 'KKK', 'het12@gmail.com', 'Krish@2006', 'Krish@2006', 9727428844, 'Anida Bhalodi', 'guest', 'active', '67c44b0b88609_IMG_20210219_221851_709-removebg-preview.png', NULL),
(23, 'Admin123', 'admin123@gmail.com', '1234567890', '1234567890', NULL, NULL, 'admin', 'active', '67b57bfa8d6d5_IMG-20250217-WA0039.jpg', NULL),
(30, 'Krish KK', 'kkalariya174@rku.ac.in', 'krish123', 'krish123', 1234567890, 'Anida Bhalodi', 'guest', 'active', '67cf0f895c8cd_Snapchat-901969128.jpg', '9eb8e96f1bbc7692987d748a6827cf44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `bookings_ibfk_2` (`room_no`),
  ADD KEY `fk` (`user_id`);

--
-- Indexes for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `password_reset_requests`
--
ALTER TABLE `password_reset_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `payments_ibfk_1` (`booking_id`),
  ADD KEY `payments_ibfk_2` (`user_id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`refund_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reviews_ibfk_3` (`room_no`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_no` (`room_no`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  MODIFY `message_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_reset_requests`
--
ALTER TABLE `password_reset_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `refund_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_no`) REFERENCES `rooms` (`room_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refunds_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`room_no`) REFERENCES `rooms` (`room_no`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
