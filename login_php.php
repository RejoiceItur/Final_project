<?php
// Start session
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'final_proj';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$mobile = $_POST['mobile'] ?? '';
$password = $_POST['password'] ?? '';

// Validate mobile number and password
$sql = "SELECT * FROM users WHERE mobile = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $mobile, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User authenticated successfully
    $user = $result->fetch_assoc(); // Fetch user data
    $user_id = $user['user_id'];
    $username = $user['fullname'];

    // Set session variable with user's information
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;

    // Redirect to index.php or any other page
    header("Location: index.php");
    exit();
} else {
    // Invalid mobile number or password
    $_SESSION['error'] = "Invalid mobile number or password";
    header("Location: login.php");
    exit();
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
