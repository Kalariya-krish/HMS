<?php
$con = mysqli_connect('localhost', 'root', '', '2025_PHP_LABWORK');

$t1 = "CREATE TABLE register(
                Id INT PRIMARY KEY AUTO_INCREMENT,
                Fullname VARCHAR(30),
                Email VARCHAR(30),
                Password VARCHAR(20),
                Mobile_no BIGINT(10),
                Hobbies VARCHAR(50),
                Profile_picture VARCHAR(200)
        );";


$i1 = "INSERT INTO REGISTER VALUES('1','Kalariya Kris K','kkalariya174@rku.ac.in','Krish@2006',9727428844,'Reading Dancing','kkkk456.jpg');";

try {
    // if ($con->query($t1)) {
    if ($con->query($i1)) {
        // echo "Table Created Successfully";
        echo "Data Inserted Successfully";
    }
} catch (Exception) {
    // echo "Errro in Creating Table";
    echo "Errro in Inserting Data in Table";
}
