<?php
session_start(); // Start session

// Check if the user is logged in
if (isset($_GET['username'])) {
    $username = $_GET['username']; // Retrieve username from URL parameter
    echo "Welcome, $username!";
} // else {
//     // User is not logged in, redirect to login page
//     header("Location: login.php");
//     exit(); // Always exit after header redirect
// }
?>
