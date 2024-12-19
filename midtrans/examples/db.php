<?php
// Include the config file to access the database credentials
include('config.php');

session_start();
// Create a database connection using the constants from config.php
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
