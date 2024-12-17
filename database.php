<?php
// database.php - Database connection file

$host = "localhost"; // Database host
$user = "root";      // Database username
$pass = "";          // Database password 
$db_name = "travel"; // Database name

// Create a connection
$conn = new mysqli($host, $user, $pass, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//////creating the users table
// CREATE TABLE users (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(50) NOT NULL UNIQUE,
//     email VARCHAR(100) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );

?>
