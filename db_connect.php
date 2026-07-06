<?php
$servername = "127.0.0.1";
$username = "root"; // Default XAMPP/WAMP username
$password = "";     // Default XAMPP/WAMP password
$dbname = "new_gym_membership_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}
?>