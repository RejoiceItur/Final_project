<?php
// Check if product_id is provided in the GET request
if(isset($_GET['product_id'])) {
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

    // Sanitize the product ID to prevent SQL injection
    $productId = $conn->real_escape_string($_GET['product_id']);

    // Query to fetch contact details of the seller based on product ID
    $sql = "SELECT seller_contact FROM items WHERE id = '$productId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the seller contact details
        $row = $result->fetch_assoc();
        $sellerContact = $row['seller_contact'];

        // Return the seller contact details as response
        echo $sellerContact;
    } else {
        // No seller contact details found
        echo "Seller contact details not found.";
    }

    // Close the database connection
    $conn->close();
} else {
    // Product ID is not provided in the GET request
    echo "Product ID not provided.";
}
?>
