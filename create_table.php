<?php
$con = mysqli_connect('localhost', 'root', '', 'hms');

$t1 = "CREATE TABLE Users(
                id INT PRIMARY KEY AUTO_INCREMENT,
                fullname VARCHAR(30) NOT NULL,
                email VARCHAR(30) UNIQUE NOT NULL,
                password VARCHAR(20) NOT NULL,
                confirm_password VARCHAR(20) NOT NULL,
                mobile_no BIGINT(10) NOT NULL,
                address VARCHAR(100),
                role ENUM('guest', 'admin') DEFAULT 'guest',
                profile_picture VARCHAR(200)
        );";

$t2 = "CREATE TABLE Rooms (
            room_no INT PRIMARY KEY,
            room_type VARCHAR(50) NOT NULL,
            room_price DECIMAL(10,2) NOT NULL,
            no_of_beds INT NOT NULL,
            room_status ENUM('Available', 'Booked', 'Maintenance') DEFAULT 'Available',
            room_features TEXT,
            room_image VARCHAR(255)
        );";

$t3 = "CREATE TABLE Bookings (
            booking_id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            room_no INT NOT NULL,
            check_in DATE NOT NULL,
            check_out DATE NOT NULL,
            total_price DECIMAL(10,2) NOT NULL,
            payment_status ENUM('Pending', 'Paid', 'Cancelled') DEFAULT 'Pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES Users(id),
            FOREIGN KEY (room_no) REFERENCES Rooms(room_no)
        );";

$t4 = "CREATE TABLE Payments (
            payment_id INT PRIMARY KEY AUTO_INCREMENT,
            booking_id INT NOT NULL,
            user_id INT NOT NULL,
            amount DECIMAL(10,2) NOT NULL,
            payment_method ENUM('Credit_card', 'Debit_card', 'Paypal', 'Cash') NOT NULL,
            payment_status ENUM('Pending', 'Completed', 'Failed') DEFAULT 'Pending',
            transaction_id VARCHAR(100) UNIQUE,
            payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (booking_id) REFERENCES Bookings(booking_id),
            FOREIGN KEY (user_id) REFERENCES Users(id)
        );";

$t5 = "CREATE TABLE Offers (
            offer_id INT PRIMARY KEY AUTO_INCREMENT,
            discount_percentage INT NOT NULL CHECK (discount_percentage BETWEEN 1 AND 100),
            valid_from DATE NOT NULL,
            valid_to DATE NOT NULL,
            status ENUM('Active', 'Expired') DEFAULT 'Active'
        );";

$t6 = "CREATE TABLE Reviews (
            review_id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            room_no INT NOT NULL,
            rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
            comment TEXT,
            review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES Users(id),
            FOREIGN KEY (room_no) REFERENCES Rooms(room_no)
        );";

$t7 = "CREATE TABLE Bills (
            bill_id INT PRIMARY KEY AUTO_INCREMENT,
            booking_id INT NOT NULL,
            user_id INT NOT NULL,
            amount DECIMAL(10,2) NOT NULL,
            generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            pdf_path VARCHAR(255),
            FOREIGN KEY (booking_id) REFERENCES Bookings(booking_id),
            FOREIGN KEY (user_id) REFERENCES Users(id)
        );";

$t8 = "CREATE TABLE Contact_inquiries (
            message_id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL,
            subject VARCHAR(100),
            message TEXT NOT NULL,
            sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

$t9 = "CREATE TABLE IF NOT EXISTS Sliders (
            id INT PRIMARY KEY AUTO_INCREMENT,
            slider_title VARCHAR(100) DEFAULT NULL,
            slider_description TEXT DEFAULT NULL,
            slider_image VARCHAR(255) NOT NULL,
            status ENUM('Active', 'Inactive') DEFAULT 'Active',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

// $i1 = "INSERT INTO REGISTER VALUES('1','Kalariya Kris K','kkalariya174@rku.ac.in','Krish@2006',9727428844,'Reading Dancing','kkkk456.jpg');";

try {
    if ($con->query($t8)) {
        // if ($con->query($i1)) {
        echo "Table Created Successfully";
        // echo "Data Inserted Successfully";
    }
} catch (Exception) {
    echo "Errro in Creating Table";
    // echo "Errro in Inserting Data in Table";
}
