<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Delete Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }
        .home-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 24px;
            color: #007bff;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div>
    <a href="./index.php" class="home-icon"><i class="fas fa-home"></i></a>
    </div>
    <div class="container">
        <h2>Delete Product</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" required>
            
            <label for="seller_name">Seller Name:</label>
            <input type="text" id="seller_name" name="seller_name" required>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
            
            <label for="mobile_no">Mobile Number:</label>
            <input type="text" id="mobile_no" name="mobile_no" required>
            
            <button type="submit">Delete Product</button>
    </form>

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

    // Process form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_id = $_POST['product_id'];
        $seller_name = $_POST['seller_name'];
        $product_name = $_POST['product_name'];
        $mobile_no = $_POST['mobile_no'];

        // Validate input (you may need to add further validation)
        if (!empty($product_id) && !empty($seller_name) && !empty($mobile_no)) {
            // Prepare and execute the SQL query to delete the product
            $sql = "DELETE FROM items WHERE id = ? AND seller_name = ? AND seller_contact = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("iss", $product_id, $seller_name, $mobile_no);
            
            if ($stmt->execute()) {
                echo "Product deleted successfully.";
                // Insert a record into 'products_deleted' table for the deleted product
                $date_deleted = date("Y-m-d H:i:s");
                $sql = "INSERT INTO products_deleted (product_id, product_name, seller_name, date_deleted) VALUES ($product_id, '$product_name', '$seller_name', '$date_deleted')";
                // $stmt = $conn->prepare($sql);
                $conn->query($sql); // Add record to 'products_added' table
                // $stmt->bind_param("ss",$product_id, $product_name, $seller_name, $date_deleted);
                // $stmt->execute(); // Add record to 'products_deleted' table
            } else {
                echo "Error deleting product: " . $conn->error;
            }
            
            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Please fill in all the fields.";
        }
    }

    // Close the database connection
    $conn->close();
    ?>
    </div>
</body>
</html>
