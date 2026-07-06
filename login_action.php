<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $conn->real_escape_string($_POST['password']); 

    // Querying the 'login' table based on your ERD
    $sql = "SELECT loginID, memberID, username FROM login WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Store data in session variables
        $_SESSION['loginID'] = $row['loginID'];
        $_SESSION['memberID'] = $row['memberID'];
        $_SESSION['username'] = $row['username'];
        
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: index.php?error=1");
        exit();
    }
}
$conn->close();
?>