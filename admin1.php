<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Products</title>
    <style>
        .products-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Adjust the gap between products */
        }

        .product {
            width: calc(33.33% - 20px); /* Adjust the width of each product */
            border: 1px solid #ccc;
            padding: 10px;
            box-sizing: border-box;
        }

        .product img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<?php

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'final_proj';


    // Display products
    $conn = new mysqli($host, $username, $password, $database);
    $sql = "SELECT * FROM items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Products</h2>";
        echo '<div class="products-container">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p>Price: $' . $row['price'] . '</p>';
            echo '<p>Description: ' . $row['description'] . '</p>';
            echo '<p>Contact: ' . $row['seller_contact'] . '</p>';
            echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
            echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
            echo '<button type="submit">Delete</button>';
            echo '</form>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "No products found.";
    }


    // Handle product deletion
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];
            $sql_delete = "DELETE FROM items WHERE id = $delete_id";
            if ($conn->query($sql_delete) === TRUE) {
                echo "Product deleted successfully!";
            } else {
                echo "Error deleting product: " . $conn->error;
            }
        }
    }
    ?>

</body>
</html>