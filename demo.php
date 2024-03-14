<?php
// Assuming you have a form submission handling logic in "demo.php"

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if product_id is set in the POST request
    if (isset($_POST["product_id"])) {
        $selectedProductId = $_POST["product_id"];

        // Query to fetch details of the selected product
        $sql = "SELECT * FROM items WHERE id = $selectedProductId";
        $result = $conn->query($sql);

        // Display details of the selected product
        if ($result->num_rows > 0) {
            $selectedProduct = $result->fetch_assoc();
            echo '<div>';
            echo '<h2>' . $selectedProduct['name'] . '</h2>';
            echo '<img src="' . $selectedProduct['image_path'] . '" alt="' . $selectedProduct['name'] . '">';
            echo '<p><strong>Description:</strong> ' . $selectedProduct['description'] . '</p>';
            echo '<p><strong>Price:</strong> $' . $selectedProduct['price'] . '</p>';
            echo '</div>';
        } else {
            echo 'Selected product not found.';
        }
    }
}
?>
