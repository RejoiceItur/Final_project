<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging statement
    // echo "Session user id: " . $_SESSION['user_id'];
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Get data from the form
        $service_id = $_POST['service_id']; // Ensure correct field name
$user_id = $_SESSION['user_id'];
$feedback = $_POST['feedback'];

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

        // Prepare and bind the SQL statement
        $sql = "INSERT INTO feedback (service_id, user_id, feedback) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $service_id, $user_id, $feedback);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Feedback submitted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement and the connection
        $stmt->close();
        $conn->close();
    } else {
        // Redirect to login page if user is not logged in
        header("Location: login.php");
        exit();
    }
}
?>
