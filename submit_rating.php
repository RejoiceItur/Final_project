<?php
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

// Get service ID and rating from form submission
$serviceId = $_POST['service_id'];
$rating = $_POST['rating'];

// Update the rating for the service in the database
$sql = "UPDATE services SET rating = '$rating' WHERE id = '$serviceId'";

if ($conn->query($sql) === TRUE) {
    echo "Rating submitted successfully.";
} else {
    echo "Error updating rating: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
