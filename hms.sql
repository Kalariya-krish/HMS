-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2025 at 04:53 PM
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
(203, 10, 'KKK', 102, '2025-03-20', '2025-03-21', 2, 150.00, 'Pending', '2025-03-06 16:27:16', 'Not Checked-In');

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
(1, 'Alice Smith', 'alice@example.com', 'Room Availability', 'Is there a deluxe room available for next week?', '2025-02-12 16:21:14'),
(3, 'Alice Smith', 'alice@example.com', 'Room Availability', 'Is there a deluxe room available for next week?', '2025-02-12 16:21:14'),
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
(2, 'Winter Sale', 25, '2025-01-01', '2025-02-28', 'Get 25% off on all winter items.', 'winter_sale.jpg', 'Active'),
(5, 'Summer Collection Launch', 20, '2025-06-01', '2025-08-31', 'Exclusive 20% discount on the new summer collection.', '67b4295982a29pexels-goumbik-1420709.jpg', 'Active'),
(6, 'Summer Holiday', 40, '2025-12-01', '2025-12-25', 'Enjoy 40% off on gifts and accessories this Christmas.', '67b429e211da1pexels-polina-kovaleva-6185466.jpg', 'Active');

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `room_no`, `rating`, `review_text`, `created_at`) VALUES
(18, 9, 101, 5, 'Absolutely loved my stay here! The room was spotless, beautifully designed, and the bed was so comfortable. Highly recommend!', '2024-01-15 09:00:00'),
(19, 10, 102, 4, 'Great experience! The check-in process was smooth, and the staff was very accommodating. The room had a fantastic city view!', '2023-12-20 04:45:00'),
(20, 23, 103, 3, 'The hotel had a cozy vibe. Rooms were neat, but the service could be improved. Overall, a decent experience.', '2024-02-05 03:15:00'),
(21, 24, 102, 2, 'Rooms were okay, but the WiFi was slow. Not a great experience for business travelers.', '2024-01-30 06:50:00'),
(22, 10, 102, 2, 'dfghjnbvfgh', '2025-03-06 15:55:11'),
(23, 10, 102, 5, 'Very Good Room\r\n', '2025-03-06 16:28:36');

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
  `size` int DEFAULT '30',
  `capacity` int NOT NULL,
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
(1, 101, 'Room 101', 'Single', 100.00, 25, 1, 'Single Bed', 'Available', 'Basic single bed, air conditioning, desk', 'Cozy single room with modern facilities.', 'room-1.jpg'),
(2, 102, 'Room 102', 'Double', 150.00, 30, 2, 'Two Single Beds', 'Available', 'Two single beds, air conditioning, desk, TV', 'Spacious double room with essential amenities.', 'room-2.jpg'),
(3, 103, 'Suite 103', 'Suite', 300.00, 50, 3, 'King-size Bed', 'Booked', 'King-size bed, sofa, jacuzzi, air conditioning', 'Luxurious suite with jacuzzi and extra seating.', 'room-3.jpg'),
(4, 104, 'Penthouse 104', 'Penthouse', 500.00, 70, 4, 'Four-poster Bed', 'Maintenance', 'Four-poster bed, private balcony, jacuzzi, minibar', 'Exclusive penthouse with private facilities.', 'room-4.jpg'),
(5, 105, 'Room 105', 'Single', 110.00, 25, 1, 'Single Bed', 'Available', 'Single bed, air conditioning, desk, sea view', 'Comfortable single room with sea view.', 'room-5.jpg');

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
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `profile_picture` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `confirm_password`, `mobile_no`, `address`, `role`, `status`, `profile_picture`) VALUES
(9, 'KKKKKK', 'kkalariya174@rku.ac.in', '12345678', '12345678', 1234567890, 'sdfgbvd', 'admin', 'active', '67b577523ff77_IMG-20250217-WA0039.jpg'),
(10, 'KKK', 'het12@gmail.com', '123456789', '123456789', 9727428844, 'Anida Bhalodi', 'guest', 'active', '67c44b0b88609_IMG_20210219_221851_709-removebg-preview.png'),
(23, 'Admin123', 'admin123@gmail.com', '1234567890', '1234567890', NULL, NULL, 'admin', 'inactive', '67b57bfa8d6d5_IMG-20250217-WA0039.jpg'),
(24, 'Kalariya Kris K', 'kkalariya174@gmail.com', '1234567890', '1234567890', 1234567890, 'hchjnnjnvhvjf jvnnvnbrn', 'guest', 'active', '67b9e35313798IMG_20230526_225843.jpg');

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
  MODIFY `bill_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  MODIFY `message_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
